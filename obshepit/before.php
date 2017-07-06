<?php

abstract class CDish {
    public abstract function getCost();
    public abstract function getName();
}

class СSmetana extends CDish {
    public function getCost()
    {
        return 3;
    }

    public function getName()
    {
        return 'Сметана';
    }
}

class СBorsch extends CDish {
    public function getCost()
    {
        return 50;
    }

    public function getName()
    {
        return 'Борщ';
    }
}

class СBorschSSmetana extends CDish {
    public function getCost()
    {
        return 50 + 3;
    }

    public function getName()
    {
        return 'Борщ со сметаной';
    }
}


?>