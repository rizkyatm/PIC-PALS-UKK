<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateReportFotoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER after_report_foto_insert
            AFTER INSERT ON report_foto
            FOR EACH ROW
            BEGIN
                DECLARE foto_count INT;
                DECLARE delete_count INT;

                -- Hitung jumlah entri dalam report_foto dengan foto_id yang sama dengan yang baru saja dimasukkan
                SELECT COUNT(*) INTO foto_count FROM report_foto WHERE foto_id = NEW.foto_id AND status = "Laporan valid";

                -- Tentukan berapa banyak entri yang akan dihapus
                SET delete_count = foto_count - 10;

                -- Jika jumlah entri foto_id sama dengan 10 atau lebih
                IF delete_count >= 0 THEN
                    -- Hapus entri-entri tertua dari tabel foto dengan foto_id yang sama dengan soft delete
                    UPDATE fotos
                    SET deleted_at = NOW() -- Atur waktu delete
                    WHERE foto_id = NEW.foto_id
                    AND id IN (
                        SELECT id
                        FROM (
                            SELECT id
                            FROM fotos
                            WHERE foto_id = NEW.foto_id
                            ORDER BY created_at ASC
                            LIMIT delete_count
                        ) AS old_fotos
                    );
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_report_foto_insert');
    }
}

