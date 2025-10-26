erDiagram
    CUSTOMERS {
        BIGINT id
        VARCHAR nama
        VARCHAR no_tlp
        TEXT alamat
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    ORDERS {
        BIGINT id
        BIGINT customer_id
        DATE tanggal_masuk
        DATE tanggal_selesai
        VARCHAR status
        DECIMAL total_harga
        TEXT catatan
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    SERVICES {
        BIGINT id
        VARCHAR nama_layanan
        VARCHAR satuan
        DECIMAL harga_per_satuan
        TEXT deskripsi
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    ORDER_ITEMS {
        BIGINT id
        BIGINT order_id
        BIGINT service_id
        INT jumlah
        DECIMAL subtotal
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    PAYMENTS {
        BIGINT id
        BIGINT order_id
        VARCHAR metode
        DECIMAL jumlah_bayar
        DATE tanggal_bayar
        VARCHAR status
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    USERS {
        BIGINT id
        VARCHAR nama
        VARCHAR email
        VARCHAR password
        VARCHAR role
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    CUSTOMERS ||--o{ ORDERS : "memiliki"
    ORDERS ||--o{ ORDER_ITEMS : "berisi"
    SERVICES ||--o{ ORDER_ITEMS : "digunakan"
    ORDERS ||--o{ PAYMENTS : "dibayar dengan"
    USERS ||--o{ ORDERS : "diproses oleh"
