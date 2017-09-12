<?php

namespace App\Http\Command;

use Illuminate\Support\ServiceProvider;

class Command 
{
  public function exec($command){

    $exe = escapeshellcmd($command);
    $output = shell_exec($exe);
    return json_decode($output);
    
  }
    
}
