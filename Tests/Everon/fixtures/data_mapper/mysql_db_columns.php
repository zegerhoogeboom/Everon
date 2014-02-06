<?php return array (
  0 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user',
    'COLUMN_NAME' => 'id',
    'ORDINAL_POSITION' => '1',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'int',
    'CHARACTER_MAXIMUM_LENGTH' => NULL,
    'CHARACTER_OCTET_LENGTH' => NULL,
    'NUMERIC_PRECISION' => '10',
    'NUMERIC_SCALE' => '0',
    'CHARACTER_SET_NAME' => NULL,
    'COLLATION_NAME' => NULL,
    'COLUMN_TYPE' => 'int(11) unsigned',
    'COLUMN_KEY' => 'PRI',
    'EXTRA' => 'auto_increment',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  1 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user_group',
    'COLUMN_NAME' => 'id',
    'ORDINAL_POSITION' => '1',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'int',
    'CHARACTER_MAXIMUM_LENGTH' => NULL,
    'CHARACTER_OCTET_LENGTH' => NULL,
    'NUMERIC_PRECISION' => '10',
    'NUMERIC_SCALE' => '0',
    'CHARACTER_SET_NAME' => NULL,
    'COLLATION_NAME' => NULL,
    'COLUMN_TYPE' => 'int(11) unsigned',
    'COLUMN_KEY' => 'PRI',
    'EXTRA' => 'auto_increment',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  2 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user_group_rel',
    'COLUMN_NAME' => 'id',
    'ORDINAL_POSITION' => '1',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'int',
    'CHARACTER_MAXIMUM_LENGTH' => NULL,
    'CHARACTER_OCTET_LENGTH' => NULL,
    'NUMERIC_PRECISION' => '10',
    'NUMERIC_SCALE' => '0',
    'CHARACTER_SET_NAME' => NULL,
    'COLLATION_NAME' => NULL,
    'COLUMN_TYPE' => 'int(11) unsigned',
    'COLUMN_KEY' => 'PRI',
    'EXTRA' => 'auto_increment',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  3 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user',
    'COLUMN_NAME' => 'login',
    'ORDINAL_POSITION' => '2',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'varchar',
    'CHARACTER_MAXIMUM_LENGTH' => '60',
    'CHARACTER_OCTET_LENGTH' => '180',
    'NUMERIC_PRECISION' => NULL,
    'NUMERIC_SCALE' => NULL,
    'CHARACTER_SET_NAME' => 'utf8',
    'COLLATION_NAME' => 'utf8_general_ci',
    'COLUMN_TYPE' => 'varchar(60)',
    'COLUMN_KEY' => 'UNI',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  4 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user_group',
    'COLUMN_NAME' => 'name',
    'ORDINAL_POSITION' => '2',
    'COLUMN_DEFAULT' => '',
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'varchar',
    'CHARACTER_MAXIMUM_LENGTH' => '60',
    'CHARACTER_OCTET_LENGTH' => '180',
    'NUMERIC_PRECISION' => NULL,
    'NUMERIC_SCALE' => NULL,
    'CHARACTER_SET_NAME' => 'utf8',
    'COLLATION_NAME' => 'utf8_general_ci',
    'COLUMN_TYPE' => 'varchar(60)',
    'COLUMN_KEY' => '',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  5 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user_group_rel',
    'COLUMN_NAME' => 'user_id',
    'ORDINAL_POSITION' => '2',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'YES',
    'DATA_TYPE' => 'int',
    'CHARACTER_MAXIMUM_LENGTH' => NULL,
    'CHARACTER_OCTET_LENGTH' => NULL,
    'NUMERIC_PRECISION' => '10',
    'NUMERIC_SCALE' => '0',
    'CHARACTER_SET_NAME' => NULL,
    'COLLATION_NAME' => NULL,
    'COLUMN_TYPE' => 'int(11) unsigned',
    'COLUMN_KEY' => 'MUL',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  6 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user',
    'COLUMN_NAME' => 'password',
    'ORDINAL_POSITION' => '3',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'varchar',
    'CHARACTER_MAXIMUM_LENGTH' => '128',
    'CHARACTER_OCTET_LENGTH' => '384',
    'NUMERIC_PRECISION' => NULL,
    'NUMERIC_SCALE' => NULL,
    'CHARACTER_SET_NAME' => 'utf8',
    'COLLATION_NAME' => 'utf8_general_ci',
    'COLUMN_TYPE' => 'varchar(128)',
    'COLUMN_KEY' => '',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  7 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user_group_rel',
    'COLUMN_NAME' => 'group_id',
    'ORDINAL_POSITION' => '3',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'YES',
    'DATA_TYPE' => 'int',
    'CHARACTER_MAXIMUM_LENGTH' => NULL,
    'CHARACTER_OCTET_LENGTH' => NULL,
    'NUMERIC_PRECISION' => '10',
    'NUMERIC_SCALE' => '0',
    'CHARACTER_SET_NAME' => NULL,
    'COLLATION_NAME' => NULL,
    'COLUMN_TYPE' => 'int(11) unsigned',
    'COLUMN_KEY' => 'MUL',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  8 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user',
    'COLUMN_NAME' => 'first_name',
    'ORDINAL_POSITION' => '4',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'varchar',
    'CHARACTER_MAXIMUM_LENGTH' => '60',
    'CHARACTER_OCTET_LENGTH' => '180',
    'NUMERIC_PRECISION' => NULL,
    'NUMERIC_SCALE' => NULL,
    'CHARACTER_SET_NAME' => 'utf8',
    'COLLATION_NAME' => 'utf8_general_ci',
    'COLUMN_TYPE' => 'varchar(60)',
    'COLUMN_KEY' => '',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  9 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user',
    'COLUMN_NAME' => 'last_name',
    'ORDINAL_POSITION' => '5',
    'COLUMN_DEFAULT' => '',
    'IS_NULLABLE' => 'NO',
    'DATA_TYPE' => 'varchar',
    'CHARACTER_MAXIMUM_LENGTH' => '128',
    'CHARACTER_OCTET_LENGTH' => '384',
    'NUMERIC_PRECISION' => NULL,
    'NUMERIC_SCALE' => NULL,
    'CHARACTER_SET_NAME' => 'utf8',
    'COLLATION_NAME' => 'utf8_general_ci',
    'COLUMN_TYPE' => 'varchar(128)',
    'COLUMN_KEY' => '',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
  10 => 
  array (
    'TABLE_CATALOG' => 'def',
    'TABLE_SCHEMA' => 'everon_test',
    'TABLE_NAME' => 'user',
    'COLUMN_NAME' => 'daniel',
    'ORDINAL_POSITION' => '6',
    'COLUMN_DEFAULT' => NULL,
    'IS_NULLABLE' => 'YES',
    'DATA_TYPE' => 'varchar',
    'CHARACTER_MAXIMUM_LENGTH' => '20',
    'CHARACTER_OCTET_LENGTH' => '60',
    'NUMERIC_PRECISION' => NULL,
    'NUMERIC_SCALE' => NULL,
    'CHARACTER_SET_NAME' => 'utf8',
    'COLLATION_NAME' => 'utf8_general_ci',
    'COLUMN_TYPE' => 'varchar(20)',
    'COLUMN_KEY' => '',
    'EXTRA' => '',
    'PRIVILEGES' => 'select,insert,update,references',
    'COLUMN_COMMENT' => '',
  ),
); 