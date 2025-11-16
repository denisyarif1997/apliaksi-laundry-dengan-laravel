<style>
    /* 🌟 Dashboard 2025 Style */
    .dashboard-box {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .dashboard-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
    }

    .dashboard-box .inner {
        padding: 25px 20px;
        color: #fff;
    }

    .dashboard-box h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .dashboard-box p {
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.9;
        text-transform: uppercase;
    }

    .dashboard-box .icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 3rem;
        opacity: 0.25;
        transition: all 0.3s ease;
    }

    .dashboard-box:hover .icon {
        opacity: 0.5;
        transform: scale(1.1);
    }

    .dashboard-box .small-box-footer {
        display: block;
        text-align: center;
        padding: 12px;
        font-weight: 600;
        color: #fff;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        text-decoration: none;
        backdrop-filter: blur(8px);
    }

    .dashboard-box .small-box-footer:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Warna gradien modern 2025 */
    .bg-info {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
    }

    .bg-success {
        background: linear-gradient(135deg, #00b09b, #96c93d);
    }

    .bg-primary {
        background: linear-gradient(135deg, #0072ff, #00c6ff);
    }

    .bg-secondary {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
    }
</style>

<div class="row">
    @role('admin')
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="dashboard-box bg-info">
                <div class="inner">
                    <h3>{{ $user }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="dashboard-box bg-success">
                <div class="inner">
                    <h3>{{ $category }}</h3>
                    <p>Total Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="dashboard-box bg-primary">
                <div class="inner">
                    <h3>{{ $product }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th"></i>
                </div>
                <a href="{{ route('admin.product.index') }}" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="dashboard-box bg-secondary">
                <div class="inner">
                    <h3>{{ $collection }}</h3>
                    <p>Total Collections</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <a href="{{ route('admin.collection.index') }}" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endrole
</div>
