<?
include 'output.php';

$cost = 0;
$Order = array();

$Order[] = new CKotleta();
$Order[] = new CPyure(3, array(new CKetchup(2), new CHleb(2)));
$Order[] = new CChaiChyornyy(1, array(new CLimon(2)));
$Order[] = new CCofe(2);


foreach($Order as $dish)
{
    echo '<pre>'.$dish->getName().' - '.$dish->getCost().'</pre>';
    $cost += $dish->getCost();
}
echo '<pre>Итого: '.$cost.'</pre>';

?>