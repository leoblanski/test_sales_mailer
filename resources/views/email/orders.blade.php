
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Vendas do dia <?= $data['date']; ?></h2>
    <br>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Vendedor</th>
            <th scope="col">Total de vendas</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($data['orders'] as $key=>$value): ?>
                <tr>
                    <th><?= $value['employee_name'] ?></th>
                    <td><?= $value['total_amount'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
      </table>
  </body>
</html>