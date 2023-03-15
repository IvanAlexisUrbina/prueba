<h2 class="text-center">USUARIOS REGISTRADOS</h2>
<table id="usuarios-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $us ) { ?>
            <tr>
                <td><?php echo $us['usu_nombre']; ?></td>
                <td><?php echo $us['usu_correo']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

