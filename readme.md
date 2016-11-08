#Subrip (.srt) file  parser for PHP

##Installation
```
composer require mattwoo/subrip
```

###Creating srt file
```PHP
//Create subtitle position
$position = new \Mattwoo\Subrip\SubripPosition(100, 200, 100, 200);
//Create next subtitle row (single subtitle)
$row = new \Mattwoo\Subrip\SubripRow(1 '00:00:00.000', '00:00:10.000', 'text', $position);
//Create new subrip fle
$file = new \Mattwoo\Subrip\SubripFile();
//Add row to file
$file->addRow($row);
//Get created file content as string
$fileContent = $file->__toString();
```

###Reading srt file
```PHP
//Parse file into SubripFile object
$file = new \Mattwoo\Subrip\SubripFile($content);
```
