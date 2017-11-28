<?php
use PHPUnit\DbUnit\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\DbUnit\Operation\Factory;
use PHPUnit\DbUnit\DataSet\ArrayDataSet;

class BaseDBTest extends TestCase
{
    static private $pdo = null;
    private $conn = null;
    private $dataSet;
    private $fixture;

    public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo === null) {
                $setting = require(dirname(__FILE__, 2) . '/config/configurations.php');
                $params = $setting['environments'];
                self::$pdo = new PDO(
                    'mysql:host=' . $params['test']['host'] . ';dbname=' . $params['test']['name'] . ';charset=utf8',
                    $params['test']['user'],
                    $params['test']['pass']
                );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo);
        }
        return $this->conn;
    }

    public function getDataSet()
    {
        return $this->dataSet;
    }

    protected function setUp() {
        $this->dataSet = new ArrayDataSet($this->getFixture());
        parent::setUp();
    }

    public function getTearDownOperation() {
        return Factory::TRUNCATE();
    }

    public function setFixture($fixture)
    {
        $this->fixture = $fixture;
    }

    public function getFixture()
    {
        return $this->fixture;
    }
}
