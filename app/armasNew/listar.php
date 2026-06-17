<?php
echo "listar ok";
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT 
                            ARMA.ARM_CODIGO,
                            ARMA.ARM_NUMEROSERIE,
                            ARMA.ARM_BCU,
                            ARMA.TARM_CODIGO, TIPO_ARMA.TARM_DESCRIPCION,
                            ARMA.MODARM_CODIGO, MODELO_ARMA.MODARM_DESCRIPCION,
                            ARMA.UNI_CODIGO, UNIDAD.UNI_DESCRIPCION
                            FROM
                            ARMA
                            INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
                            LEFT JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                            INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
                            ORDER BY
                            ARM_CODIGO DESC
                        LIMIT 20");
                        

$consulta->execute();
echo "MySql: ".$consulta;
if ($data != "") {
    echo "data ok";
    $consulta = $pdo->prepare("SELECT * FROM ARMA WHERE ARM_CODIGO LIKE '%".$data."%' OR ARM_NUMEROSERIE LIKE '%".$data."%' OR ARM_BCU LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "<tr>
            <td>" . $data['ARM_CODIGO'] . "</td>;
            <td>" . $data['ARM_NUMEROSERIE'] . "</td>;
            <td>" . $data['ARM_BCU'] . "</td>;
            <td>" . $data['TARM_DESCRIPCION'] . "</td>;
            <td>" . $data['MODARM_DESCRIPCION'] . "</td>;
            <td>" . $data['UNI_DESCRIPCION'] . "</td>;
            <td>
                <button type='button' class='btn btn-success' onclick=Editar('" . $data['ARM_CODIGO'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminar('" . $data['ARM_CODIGO'] . "')>Eliminar</button>
            </td>        
        </tr>";
}
