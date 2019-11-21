<?php
$host = getenv('IP');
$username = 'lab7_user';
$password = '321drowssap';
$dbname = 'world';
$country = $_GET['country'];
$context = $_GET['context'];
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
$stmt2 = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON countries.code=cities.country_code WHERE cities.country_code = countries.code AND countries.name LIKE '%$country%';");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if($context=='cities'){ $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);?>
    <table>
        <tr>
            <td>Name</td>
            <td>District</td>
            <td>Population</td>
        </tr>
        
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['name'];?></td>
                <td><?= $row['district'];?></td>
                <td><?= $row['population'];?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php }else{ ?>
    <table>
        <tr>
            <td>Name</td>
            <td>Continent</td>
            <td>Independence</td>
            <td>Head of State</td>
        </tr>
    
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= $row['name'];?></td>
            <td><?= $row['continent'];?></td>
            <td><?= $row['independence_year'];?></td>
            <td><?= $row['head_of_state'];?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php } ?>