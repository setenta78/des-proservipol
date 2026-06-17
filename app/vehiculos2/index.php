<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Lista de Vehículos</h2>
            <a href="create.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Agregar Vehículo</a>
        </div>

        <?php
        require_once "config.php";

        $sql = "SELECT  
                    VEHICULO.VEH_CODIGO,
                    TIPO_VEHICULO.TVEH_DESCRIPCION,
                    PROCEDENCIA_RECURSO.PREC_DESCRIPCION,
                    VEHICULO.VEH_BCU,
                    VEHICULO.VEH_SAP,
                    MARCA_VEHICULO.MVEH_DESCRIPCION,
                    MODELO_VEHICULO.MODVEH_DESCRIPCION,
                    VEHICULO.VEH_PATENTE,
                    VEHICULO.VEH_NUMEROINSITUCIONAL,
                    VEHICULO.ANNO_FABRICACION,
                    UNIDAD.UNI_DESCRIPCION
                FROM
                    VEHICULO
                    INNER JOIN TIPO_VEHICULO ON VEHICULO.TVEH_CODIGO = TIPO_VEHICULO.TVEH_CODIGO
                    LEFT JOIN MODELO_VEHICULO ON VEHICULO.MODVEH_CODIGO = MODELO_VEHICULO.MODVEH_CODIGO
                    LEFT JOIN UNIDAD ON VEHICULO.UNI_CODIGO = UNIDAD.UNI_CODIGO
                    LEFT JOIN MARCA_VEHICULO ON MODELO_VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO
                    INNER JOIN PROCEDENCIA_RECURSO ON VEHICULO.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO
                ORDER BY VEH_CODIGO DESC
                LIMIT 30";

        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='min-w-full border-collapse table-auto text-sm bg-white shadow-md rounded'>";
            echo "<thead class='bg-gray-200'>";
            echo "<tr>";
            echo "<th class='border px-4 py-2'>Código</th>";
            echo "<th class='border px-4 py-2'>Tipo</th>";
            echo "<th class='border px-4 py-2'>Procedencia</th>";
            echo "<th class='border px-4 py-2'>BCU</th>";
            echo "<th class='border px-4 py-2'>SAP</th>";
            echo "<th class='border px-4 py-2'>Marca</th>";
            echo "<th class='border px-4 py-2'>Modelo</th>";
            echo "<th class='border px-4 py-2'>Patente</th>";
            echo "<th class='border px-4 py-2'>Número Institucional</th>";
            echo "<th class='border px-4 py-2'>Año</th>";
            echo "<th class='border px-4 py-2'>Unidad</th>";
            echo "<th class='border px-4 py-2'>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='border-t'>";
                echo "<td class='border px-4 py-2'>{$row['VEH_CODIGO']}</td>";
                echo "<td class='border px-4 py-2'>{$row['TVEH_DESCRIPCION']}</td>";
                echo "<td class='border px-4 py-2'>{$row['PREC_DESCRIPCION']}</td>";
                echo "<td class='border px-4 py-2'>{$row['VEH_BCU']}</td>";
                echo "<td class='border px-4 py-2'>{$row['VEH_SAP']}</td>";
                echo "<td class='border px-4 py-2'>{$row['MVEH_DESCRIPCION']}</td>";
                echo "<td class='border px-4 py-2'>{$row['MODVEH_DESCRIPCION']}</td>";
                echo "<td class='border px-4 py-2'>{$row['VEH_PATENTE']}</td>";
                echo "<td class='border px-4 py-2'>{$row['VEH_NUMEROINSITUCIONAL']}</td>";
                echo "<td class='border px-4 py-2'>{$row['ANNO_FABRICACION']}</td>";
                echo "<td class='border px-4 py-2'>{$row['UNI_DESCRIPCION']}</td>";
                echo "<td class='border px-4 py-2'>
                        <a href='update.php?id={$row['VEH_CODIGO']}' class='bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600'>Editar</a>
                        <a href='delete.php?id={$row['VEH_CODIGO']}' class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-center text-gray-600'>No existen registros.</p>";
        }

        mysqli_close($link);
        ?>
    </div>

</body>

</html>