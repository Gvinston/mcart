<?

abstract class CDescriptionOrder
{
    protected $name;
    protected $cost;
    protected $number;
    protected $maxNumber;

    public function getName()
    {
        if($this->number < 1) return false;


        if($this->number > 1) {
           return $this->name." x ".$this->number;
        }

    }

    public function getCost()
    {
        return $this->number * $this->cost;
    }


    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }



    public function numberUp()
    {
        if(!empty($this->maxNumber))
        {
            if($this->number < $this->maxNumber)
            {
                $this->number++;
            }
        }
        else
        {
            $this->number++;
        }

        return $this->number;
    }

    public function numberDown()
    {
        if($this->number > 0)
        {
            $this->number--;
        }
        return $this->number;
    }
}


class CHleb extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "хлеб";
        $this->cost = 1;
        $this->number = $number;

    }
}

class CSmetana extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "сметана";
        $this->cost = 3;
        $this->number = $number;
        $this->maxNumber = 1;
    }
}

class CSlivki extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "сливки";
        $this->cost = 6;
        $this->number = $number;
        $this->maxNumber = 1000;
    }
}

class CMoloko extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "молоко";
        $this->cost = 5;
        $this->number = $number;
        $this->maxNumber = 1;
    }
}

class CSMoloko extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "cгущенное молоко";
        $this->cost = 4;
        $this->number = $number;
        $this->maxNumber = 1;
    }
}

class CDjem extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "джем";
        $this->cost = 5;
        $this->number = $number;
        $this->maxNumber = 1;
    }
}

class CKetchup extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "кетчуп";
        $this->cost = 3;
        $this->number = $number;
        $this->maxNumber = 1;
    }
}


class CLimon extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "лимон";
        $this->cost = 1;
        $this->number = $number;

    }
}

class CSyrnyiSous extends CDescriptionOrder {

    public function __construct($number = 1)
    {
        $this->name = "кетчуп";
        $this->cost = 3;
        $this->number = $number;
        $this->maxNumber = 1;
    }
}

abstract class CDish extends CDescriptionOrder
{
    protected $additives = array();
    protected $availableAdditives;

    public function getName()
    {
        $n = $this->name;
        if (!empty($this->additives))
        {
            foreach ($this->additives as $add)
            {
                if ($an = $add->getName())
                {
                    $arAddNames[] = $an;
                }
            }
        }

        if (!empty($arAddNames)) $n .= ' (' . implode(', ', $arAddNames) . ')';

        if($this->number > 1) $n .= ' x '.$this->number;

        return $n;
    }

    public function getCost()
    {
        $cost = parent::getCost();
        if (!empty($this->additives))
        {
            foreach ($this->additives as $add)
            {
                if ($ac = $add->getCost())
                {
                    $cost += $ac * $this->number;
                }
            }
        }

        return $cost;
    }

    public function addAdditive($add)
    {
        if(in_array(get_class($add), $this->availableAdditives))
        {
            $this->additives[] = $add;
            return true;
        }
        return false;
    }

}

class CBorsch extends CDish
{

    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Борщ';
        $this->cost = 50;
        $this->availableAdditives = array('CKetchup', 'CHleb');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}

class CFri extends CDish
{
    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Картофель фри';
        $this->cost = 30;
        $this->availableAdditives = array('CKetchup');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}

class CPyure extends CDish
{

    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Картофельное пюре';
        $this->cost = 25;
        $this->availableAdditives = array('CKetchup', 'CHleb');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}

class CShashlyk extends CDish
{
    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Шашлык';
        $this->cost = 50;
        $this->availableAdditives = array('CKetchup');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}

class CKotleta extends CDish
{
    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Котлета';
        $this->cost = 50;
        $this->availableAdditives = array('CKetchup');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}

class CChaiChyornyy extends CDish
{
    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Чёрный чай';
        $this->cost = 20;
        $this->availableAdditives = array('CLimon');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}



class CBliny extends CDish
{
    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Блины';
        $this->cost = 30;
        $this->availableAdditives = array('CSmetana', 'CSMoloko', 'CDjem');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}

class CCofe extends CDish
{
    public function __construct($number = 1, $arAdd = array())
    {
        $this->number = $number;
        $this->name = 'Кофе';
        $this->cost = 30;
        $this->availableAdditives = array('CSlivki');
        foreach($arAdd as $d) $this->addAdditive($d);
    }
}
?>