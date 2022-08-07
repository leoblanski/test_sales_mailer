
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Vendas do dia <?= $data['date']; ?></h2>
    <br>
    <?php foreach($data['orders'] as $key=>$value): ?>
        <b>Vendedor: </b> <?= str_replace(".", ",", $value['employee_name']) ?>
        <br>
        <b>Total em vendas: </b> R$<?= str_replace(".", ",", $value['employee_amount']) ?>
        <br><br>
    <?php endforeach ?>
  </body>
</html>