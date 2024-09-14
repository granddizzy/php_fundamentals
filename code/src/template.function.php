<?php

function handleError(string $errorText): string
{
  return "\033[31m" . $errorText . " \r\n \033[97m";
}

function handleHelp(): string
{
  $help = "Программа работы с файловым хранилищем \r\n";

  $help .= "Порядок вызова\r\n\r\n";

  $help .= "php /code/app.php [COMMAND] \r\n\r\n";

  $help .= "Доступные команды: \r\n";
  $help .= "read-all - чтение всего файла \r\n";
  $help .= "add - добавление записи \r\n";
  $help .= "clear - очистка файла \r\n";
  $help .= "get-birthdays - показать дни рождения на текущий день \r\n";
  $help .= "get-near-birthdays - показать дни рождения на в пределах 10 дней от текущего дня \r\n";
  $help .= "clear - очистка файла \r\n";
  $help .= "read-profiles - показать список профилей \r\n";
  $help .= "read-profile <filename> - прочитать файл профиля \r\n";
  $help .= "help - помощь \r\n";

  return $help;
}