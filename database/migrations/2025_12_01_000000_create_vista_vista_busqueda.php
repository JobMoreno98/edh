<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vista_busqueda AS
            

            SELECT
                libros.id AS id,
                libros.titulo AS titulo,
                libros.slug AS slug,
                libros.volumen AS volumen,
                libros.anio AS anio,
                libros.resumen AS descripcion,  -- se renombra para coincidir con publicaciones
                libros.cita AS cita,
                libros.isbn AS isbn,
                libros.isbn_coleccion AS isbn_coleccion,
                libros.palabras_clave AS palabras_clave,
                libros.resena AS resena,
                libros.doi AS doi,
                libros.estado AS estado,

                GROUP_CONCAT(
                    DISTINCT CONCAT(autores.nombre, ' ', autores.apellido)
                    SEPARATOR ', '
                ) AS nombre_autor,

                'libro' AS tipo

            FROM libros
            LEFT JOIN libro_autor ON libros.id = libro_autor.libro_id
            LEFT JOIN autores ON libro_autor.autor_id = autores.id

            WHERE libros.deleted_at IS NULL
              AND libros.estado = 1

            GROUP BY
                libros.id, libros.titulo, libros.slug, libros.volumen, libros.anio,
                libros.resumen, libros.cita, libros.isbn, libros.isbn_coleccion,
                libros.palabras_clave, libros.resena, libros.doi, libros.estado


            UNION ALL


            SELECT
                publicaciones.id AS id,
                publicaciones.titulo AS titulo,
                NULL AS slug,
                NULL AS volumen,
                NULL AS anio,
                publicaciones.descripcion AS descripcion,
                NULL AS cita,
                NULL AS isbn,
                NULL AS isbn_coleccion,
                NULL AS palabras_clave,
                NULL AS resena,
                NULL AS doi,
                publicaciones.estado AS estado,
                NULL AS nombre_autor,
                'publicacion' AS tipo

            FROM publicaciones

            WHERE publicaciones.deleted_at IS NULL
              AND publicaciones.estado = 1;

        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_busqueda");
    }
};
