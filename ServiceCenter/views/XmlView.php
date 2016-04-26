<?php


class XmlView extends View
{
	

    public function fetch()
    {
        //$xml = '';
        $xml .= '<' . '?xml version="1.0" encoding="UTF-8" ?' . '>' . "\n";
        $xml .= '<Module>'. "\n";;
        $xml .= '<ModulePrefs title="' . $this->title . '" height="300" scrolling="true" >'. "\n";;
        $xml .= '<Require feature="setprefs" />'. "\n";;
        $xml .= '</ModulePrefs>'. "\n";;

        foreach ($this->items as $id => $item)
        {
            $xml .= '<UserPref name="' . $item['prefName'] . '" default_value="' . $item['prefValue'] . '" datatype="hidden"/>'. "\n";;
        }
        $xml .= '<Content type="url" href="http://sc.ec.nccu.edu.tw/index.php?act='. $this->action .'"/>'. "\n";;
        $xml .= '</Module>'. "\n";;
        return $xml;
    }


    public function render()
    {
        header('Content-Type: text/xml; charset=utf-8');
        echo $this->fetch();
    }

}
