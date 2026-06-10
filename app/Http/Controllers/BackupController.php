<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ifsnop\Mysqldump\Mysqldump;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function index()
    {
        $files = Storage::files('backups');
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'filename' => basename($file),
                'size' => $this->formatSize(Storage::size($file)),
                'date' => Carbon::createFromTimestamp(Storage::lastModified($file))->format('d F Y H:i:s'),
                'raw_date' => Storage::lastModified($file) // for sorting
            ];
        }

        // Sort by date desc
        usort($backups, function ($a, $b) {
            return $b['raw_date'] <=> $a['raw_date'];
        });

        return view('admin.backup.index', compact('backups'));
    }

    public function store()
    {
        try {
            $filename = 'backup-' . Carbon::now()->format('Y-m-d-H-i-s') . '.sql';
            $path = storage_path('app/backups/' . $filename);
            
            // Ensure directory exists
            if (!file_exists(storage_path('app/backups'))) {
                mkdir(storage_path('app/backups'), 0755, true);
            }

            $dbName = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');

            $dump = new Mysqldump("mysql:host=$host;dbname=$dbName", $username, $password);
            $dump->start($path);

            return redirect()->route('admin.backup.index')->with('success', 'Database berhasil dibackup!');
        } catch (\Exception $e) {
            return redirect()->route('admin.backup.index')->with('error', 'Gagal backup database: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        if (Storage::exists('backups/' . $filename)) {
            return Storage::download('backups/' . $filename);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    public function destroy($filename)
    {
        if (Storage::exists('backups/' . $filename)) {
            Storage::delete('backups/' . $filename);
            return redirect()->back()->with('success', 'Backup berhasil dihapus');
        }
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    private function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes / (1024 ** $pow), 2) . ' ' . $units[$pow];
    }

    public function resetDatabase(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if ($request->password !== 'denisarifudin97') {
            return redirect()->back()->with('error', 'Password salah! Tidak dapat mereset database.');
        }

        try {
            // Disable foreign key checks
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Truncate Transaction tables
            \App\Models\TransactionDetailModel::truncate();
            \App\Models\PaymentModel::truncate();
            \App\Models\TransactionModel::truncate();
            \App\models\CustomerModel::truncate();
            // \App\models\LaundryModel::truncate();
            // \App\models\LaundryTypeModel::truncate();
            \App\models\PaymentModel::truncate();
            \App\models\TransactionDetailModel::truncate();
            \App\models\TransactionModel::truncate();
            \App\models\ItemModel::truncate();
            \App\models\MesinCuciModel::truncate();
            \App\models\ServicesModel::truncate();
            // \App\models\user_model::truncate();

            // Enable foreign key checks
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->back()->with('success', 'Database transaksi berhasil direset!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mereset database: ' . $e->getMessage());
        }
    }
    public function import(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:sql,txt|max:51200', // limit 50MB
        ]);

        $file = $request->file('backup_file');
        $path = $file->getRealPath();

        // Increase limits for large imports
        ini_set('memory_limit', '-1');
        set_time_limit(300); // 5 minutes

        // Disable Foreign Key Checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        try {
            // Step 1: Drop all existing tables to prevent "Table already exists" errors
            $tables = \DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $array = json_decode(json_encode($table), true);
                $tableName = array_values($array)[0];
                \DB::statement("DROP TABLE IF EXISTS `{$tableName}`");
            }

            // Step 2: Read file line by line to handle large files
            $handle = fopen($path, "r");
            if ($handle) {
                $query = '';
                while (($line = fgets($handle)) !== false) {
                    $trimLine = trim($line);
                    
                    // Skip comments and empty lines
                    if ($trimLine === '' || strpos($trimLine, '--') === 0 || strpos($trimLine, '/*') === 0) {
                        continue;
                    }

                    $query .= $line;
                    
                    // If line ends with semicolon, execute query
                    if (substr($trimLine, -1, 1) == ';') {
                        try {
                            \DB::statement($query);
                        } catch (\Exception $e) {
                            // Log error but continue? Or stop?
                            // For database restoration, usually we want to stop on critical errors.
                            // But some 'EXISTS' errors might be ignorable. 
                            // Let's rethrow for now to be safe.
                            throw $e;
                        }
                        $query = '';
                    }
                }
                fclose($handle);
            }

            // Re-enable Foreign Key Checks
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route('admin.backup.index')->with('success', 'Database berhasil direstore dari backup!');
        } catch (\Exception $e) {
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route('admin.backup.index')->with('error', 'Gagal restore database: ' . $e->getMessage());
        }
    }
}
