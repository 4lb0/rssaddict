<?php

class Article
{
    public function strtrmvistl($str, $maxlen = 64, $right_justify = false, $delimter = "<br>\n") {
        if(($len = strlen($str = chop($str))) > ($maxlen = max($maxlen, 12))) {
            $newstr = substr($str, 0, $maxlen - 3);

            if($len > ($maxlen - 3)) {
                $endlen = min(($len - strlen($newstr)), $maxlen - 3);
                $newstr .= "..." . $delimter;

                if($right_justify) {
                    $newstr .= str_pad('', $maxlen - $endlen - 3, ' ');
                    $newstr .= "..." . substr($str, $len - $endlen);
                }
            }

            return($newstr);
        }

        return($str);
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->strtrmvistl(strip_tags($this->description), 200);
    }

    public function getLink()
    {
        return link_to('go/' . $this->id);
    }

    public function getProvider()
    {
        global $config;
        return $config[$this->provider]['_label'];
    }

    public function getDate()
    {
        return strftime("%A %R hs", strtotime($this->pub_date));
    }
}

