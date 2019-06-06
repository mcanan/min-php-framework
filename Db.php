<?php
namespace mcanan\framework;

class Db
{
    private $handler;

    private function getHandler()
    {
        if (is_null($this->handler)) {
            $this->handler = mysqli_connect(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASSWORD);
            mysqli_set_charset("utf8", $this->handler);
            mysqli_select_db(CONF_DB_DBNAME, $this->handler);
        }

        return $this->handler;
    }

    public function getError()
    {
        return mysqli_error($this->getHandler());
    }

    public function consulta($consulta)
    {
        $resultado = array();
        $result = mysqli_query($consulta, $this->getHandler());
        if ($result) {
            while ($query_data  =  mysqli_fetch_array($result)) {
                $resultado[] = $query_data;
            }
        } else {
            error_log(
                "DB::consulta - ".
                mysqli_errno($this->getHandler()).": ".
                mysqli_error($this->getHandler())." - ".
                $consulta
            );
        }

        return ($resultado);
    }

    public function update($consulta)
    {
        $result = mysqli_query($consulta, $this->getHandler());
        if (!$result) {
            error_log(
                "DB::update - ".
                mysqli_errno($this->getHandler()).": ".
                mysqli_error($this->getHandler())." - ".
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
            $retorno = mysqli_affected_rows($this->getHandler());
        } else {
            error_log(
                "DB::updateAndReturnAffectedRows - ".
                mysqli_errno($this->getHandler()).": ".
                mysqli_error($this->getHandler()). " - ".
                $consulta
            );
        }

        return $retorno;
    }

    public function getLastInsertId()
    {
        return mysqli_insert_id($this->getHandler());
    }

    public function escape($string)
    {
        if (strlen($string)==0 || $string=='0') {
            return $string;
        }

        $resultado = mysqli_real_escape_string($string, $this->getHandler());

        if (!$resultado) {
            $resultado = $string;
            error_log(
                "DB::escape - ".
                mysqli_errno($this->getHandler()).": ".
                mysqli_error($this->getHandler())." - ".
                $string
            );
        }

        return $resultado;
    }
}
