
<table class='table table-bordered table-responsive'>
    <thead>
      <tr>
        <th></th>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<th style='text-align: center;background-color: #4c83ff;color: white;'>$model->PAKET_NM</th>";
        }?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="background-color: #ff0000; padding-left: 5px; color: white;">PAKET DURATION</td>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<td style='text-align: center;'>$model->PAKET_DURATION</td>";
        }?>
      </tr>
      <tr>
        <td style="background-color: #ff0000; padding-left: 5px; color: white;">PAKET DURATION BONUS</td>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<td style='text-align: center;'>$model->PAKET_DURATION_BONUS</td>";
        }?>
      </tr>
      <tr>
        <td style="background-color: #ff0000; padding-left: 5px; color: white;">HARGA BULAN</td>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<td style='text-align: center;'>$model->HARGA_BULAN</td>";
        }?>
      </tr>
      <tr>
        <td style="background-color: #ff0000; padding-left: 5px; color: white;">HARGA HARI</td>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<td style='text-align: center;'>$model->HARGA_HARI</td>";
        }?>
      </tr>
      <tr>
        <td style="background-color: #ff0000; padding-left: 5px; color: white;">HARGA PAKET</td>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<td style='text-align: center;'>$model->HARGA_PAKET</td>";
        }?>
      </tr>
      <tr>
        <td style="background-color: #ff0000; padding-left: 5px; color: white;">HARGA PAKET HARI</td>
        <?php foreach ($dataProvider->getModels() as $model) {
            echo "<td style='text-align: center;'>$model->HARGA_PAKET_HARI</td>";
        }?>
      </tr>
    </tbody>
  </table>