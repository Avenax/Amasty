<?php



class First {

    /**
     * return self class name
     * @return string
     */
    public function getClassname() {
        return __CLASS__;
    }

    /**
     * return value
     * @param string $letter
     * @return string
     */
    public function getLetter(string $letter) {
        return $letter;
    }
}