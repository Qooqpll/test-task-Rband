<?php

class CreatorXml
{

    protected $db;
    protected $qty = 25;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createXml()
    {
        $productsData = $this->db->connection()->select('oc_product', $this->getCondition(), false, null);

        $xml = new DOMDocument('1.0', 'utf-8');
        $productsXml = $xml->appendChild($xml->createElement('products'));

        foreach ($productsData as $productData) {
            $productXml = $productsXml->appendChild($xml->createElement('product'));

            foreach ($productData as $key => $value) {
                $productXml->appendChild($xml->createElement($key, $value));
            }

        }

        $xml->save('test.xml');
    }

    public function getCondition()
    {
        $page = $_GET['page'];
        if(is_numeric($page)) {
            $value = $page ? $this->qty * $page : false;
            $firstValue = $value - $this->qty;
        }

        if($page == 'all') {
            return '';
        }

        return 'product_id >= ' . $firstValue . ' AND product_id <=' . $value;
    }

    public function getXml()
    {
        $xml = simplexml_load_file('test.xml');
        echo '<pre>';
        print_r($xml);
        echo '</pre>';
    }

}