<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-02-28
 * Time: 11:00
 */
namespace Model;

interface ProfilsInterface
{
    public function findAll();

    public function save(Array $profils);
}
