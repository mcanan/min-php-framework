<?php
class Db2
{
    private $handler;

    private function getHandler()
    {
        if (is_null($this->handler)) {
            $this->handler = mysql_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASSWORD);
            mysql_set_charset("utf8", $this->handler);
            mysql_select_db(CONF_DB_DBNAME, $this->handler);
        }

        return $this->handler;
    }

    public function getError()
    {
        return mysql_error($this->getHandler());
    }

    public function consulta($consulta)
    {
        $resultado = array();
        $result = mysql_query($consulta, $this->getHandler());
        if ($result) {
            while ($query_data  =  mysql_fetch_array($result)) {
                $resultado[] = $query_data;
            }
        } else {
            error_log(
                "DB::consulta - ".
                mysql_errno($this->getHandler()).": ".
                mysql_error($this->getHandler())." - ".
                $consulta
            );
        }

        return ($resultado);
    }

    public function update($consulta)
    {
        $result = mysql_query($consulta, $this->getHandler());
        if (!$result) {
            error_log(
                "DB::update - ".
                mysql_errno($this->getHandler()).": ".
                mysql_error($this->getHandler())." - ".
                $consulta
            );
        }

        return $result;
    }

    public function updateAndReturnAffectedRows($consulta)
    {
        $retorno = 0;
        $result = $this->update($consulta);
        if ($result) {
            $retorno = mysql_affected_rows($this->getHandler());
        } else {
            error_log(
                "DB::updateAndReturnAffectedRows - ".
                mysql_errno($this->getHandler()).": ".
                mysql_error($this->getHandler()). " - ".
                $consulta
            );
        }

        return $retorno;
    }

    public function getLastInsertId()
    {
        return mysql_insert_id($this->getHandler());
    }

    public function escape($string)
    {
        if (strlen($string)==0 || $string=='0') {
            return $string;
        }

        $resultado = mysql_real_escape_string($string, $this->getHandler());

        if (!$resultado) {
            $resultado = $string;
            error_log(
                "DB::escape - ".
                mysql_errno($this->getHandler()).": ".
                mysql_error($this->getHandler())." - ".
                $string
            );
        }

        return $resultado;
    }
}
