<!DOCTYPE html>
<html>
<head>
    <title>index</title>
    <?php
    $dbopts = parse_url(getenv('DATABASE_URL'));
    $app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
    );
    $app->get('/db/', function() use($app) {
      $st = $app['pdo']->prepare('SELECT name FROM test_table');
      $st->execute();

      $names = array();
      while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
        $app['monolog']->addDebug('Row ' . $row['name']);
        $names[] = $row;
      }

      return $app['twig']->render('database.twig', array(
        'names' => $names
      ));
    });
    ?>
    <meta http-equiv="refresh" content="0; url = https://project-444.herokuapp.com/homepage.php" />
</head>
<body>
    <p>Redirecting to another URL</p>
</body>
</html>