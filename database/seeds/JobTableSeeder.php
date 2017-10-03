<?php

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Jobs')->delete();

		// data init
		Job::create(array(
				'name' => 'logistic regression',
				'observation' => 'test',
				'algorithm' => 'lg.py',
				'outPut' => 'lg.log',
				'submitCondor' => 'lg.submit',
				'idState' => 2,
				'idInsertUser' => 1,
				'iteracion' => 1
			));

		// data init
		Job::create(array(
				'name' => 'Naive Bayes Classification',
				'observation' => 'test',
				'algorithm' => 'NaiveBayesClassification.py',
				'outPut' => 'NaiveBayesClassification.py',
				'submitCondor' => 'NaiveBayesClassification.submit',
				'idState' => '2',
				'idInsertUser' => 1,
				'iteracion' => 2
			));
	}
}