<?php
require_once '1/PHPWord.php';

$PHPWord = new PHPWord();

$PHPWord->setDefaultFontName('Times New Roman');
$PHPWord->setDefaultFontSize(12);

$sectionStyle = array(
    'orientation' => 'null', // альбомная ориентация страницы
    'marginTop' => '518', // по-умолчанию равен 1418* и соответствует 2,5 см отступа сверху
    'marginLeft' => '1418', // по-умолчанию равен 1418* и соответствует 2,5 см отступа слева
    'marginRight' => '1418', // по-умолчанию равен 1418* и соответствует 2,5 см отступа справа
    'marginBottom' => '1134', // по-умолчанию равен 1134* и соответствует 2 см отступа снизу
    'pageSizeW' => '11906', // по-умолчанию равен 11906* и соответствует 210 мм по ширине
    'pageSizeH' => '16838', // по-умолчанию равен 16838* и соответствует 297 мм по высоте
);
$section = $PHPWord->createSection($sectionStyle);

$imageStyle = array('widht'=>100, 'height'=>100, 'align'=>'center');
$section->addImage('images/logo.png', $imageStyle);


$fontStyle = array('color'=>'000000', 'size'=>12, 'bold'=>false, 'align'=>'center');
$section->addText('Министерство транспорта Российской Федерации \n Федеральное агентство морского и речного транспорта', $fontStyle);

//$writer = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
//$writer->save('document.docx');

header("Content-Type: application/msword");
header("Content-Transfer-Encoding: binary");
header('Content-Disposition: attachment;filename="document.docx"');
header('Cache-Control: max-age=0');
$writer = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$writer->save('php://output');

?>