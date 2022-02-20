<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RefDisease extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared('
            INSERT INTO diseases (description) VALUES ( "Alzheimers disease");
            INSERT INTO diseases (description) VALUES ( "Amyotrophic lateral sclerosis");
            INSERT INTO diseases (description) VALUES ( "Anorexia nervosa");
            INSERT INTO diseases (description) VALUES ( "Anxiety disorder");
            INSERT INTO diseases (description) VALUES ( "Asthma");
            INSERT INTO diseases (description) VALUES ( "Atherosclerosis");
            INSERT INTO diseases (description) VALUES ( "Attention deficit hyperactivity disorder");
            INSERT INTO diseases (description) VALUES ( "Autism");
            INSERT INTO diseases (description) VALUES ( "Autoimmune diseases");
            INSERT INTO diseases (description) VALUES ( "Bipolar disorder");
            INSERT INTO diseases (description) VALUES ( "Cancer");
            INSERT INTO diseases (description) VALUES ( "Chronic fatigue syndrome");
            INSERT INTO diseases (description) VALUES ( "Chronic obstructive pulmonary disease");
            INSERT INTO diseases (description) VALUES ( "Crohns disease");
            INSERT INTO diseases (description) VALUES ( "Coronary heart disease");
            INSERT INTO diseases (description) VALUES ( "Dementia");
            INSERT INTO diseases (description) VALUES ( "Depression");
            INSERT INTO diseases (description) VALUES ( "Diabetes mellitus type 1");
            INSERT INTO diseases (description) VALUES ( "Diabetes mellitus type 2");
            INSERT INTO diseases (description) VALUES ( "Dilated cardiomyopathy");
            INSERT INTO diseases (description) VALUES ( "Epilepsy");
            INSERT INTO diseases (description) VALUES ( "Guillain–Barré syndrome");
            INSERT INTO diseases (description) VALUES ( "Irritable bowel syndrome");
            INSERT INTO diseases (description) VALUES ( "Low back pain");
            INSERT INTO diseases (description) VALUES ( "Lupus");
            INSERT INTO diseases (description) VALUES ( "Metabolic syndrome");
            INSERT INTO diseases (description) VALUES ( "Multiple sclerosis");
            INSERT INTO diseases (description) VALUES ( "Myocardial infarction");
            INSERT INTO diseases (description) VALUES ( "Obesity");
            INSERT INTO diseases (description) VALUES ( "Obsessive–compulsive disorder");
            INSERT INTO diseases (description) VALUES ( "Panic disorder");
            INSERT INTO diseases (description) VALUES ( "Parkinsons disease");
            INSERT INTO diseases (description) VALUES ( "Psoriasis");
            INSERT INTO diseases (description) VALUES ( "Rheumatoid arthritis");
            INSERT INTO diseases (description) VALUES ( "Sarcoidosis");
            INSERT INTO diseases (description) VALUES ( "Schizophrenia");
            INSERT INTO diseases (description) VALUES ( "Stroke");
            INSERT INTO diseases (description) VALUES ( "Thromboangiitis obliterans");
            INSERT INTO diseases (description) VALUES ( "Tourette syndrome");
            INSERT INTO diseases (description) VALUES ( "Tuberculosis");
            INSERT INTO diseases (description) VALUES ( "Vasculitis");
        ');
    }
}
