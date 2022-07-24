<?php
require_once('model/MovieDB.php');
echo MovieDB::getMovieCount()['movieLength'];