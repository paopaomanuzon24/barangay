<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RefLanguage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared('
            INSERT INTO languages (description) VALUES ( "Mandarin");
            INSERT INTO languages (description) VALUES ( "Spanish");
            INSERT INTO languages (description) VALUES ( "English");
            INSERT INTO languages (description) VALUES ( "Hindi");
            INSERT INTO languages (description) VALUES ( "Arabic");
            INSERT INTO languages (description) VALUES ( "Portuguese");
            INSERT INTO languages (description) VALUES ( "Bengali");
            INSERT INTO languages (description) VALUES ( "Russian");
            INSERT INTO languages (description) VALUES ( "Japanese");
            INSERT INTO languages (description) VALUES ( "Punjabi");
            INSERT INTO languages (description) VALUES ( "German");
            INSERT INTO languages (description) VALUES ( "Javanese");
            INSERT INTO languages (description) VALUES ( "Wu (inc. Shanghainese)");
            INSERT INTO languages (description) VALUES ( "Malay/Indonesian");
            INSERT INTO languages (description) VALUES ( "Telugu");
            INSERT INTO languages (description) VALUES ( "Vietnamese");
            INSERT INTO languages (description) VALUES ( "Korean");
            INSERT INTO languages (description) VALUES ( "French");
            INSERT INTO languages (description) VALUES ( "Marathi");
            INSERT INTO languages (description) VALUES ( "Tamil");
            INSERT INTO languages (description) VALUES ( "Urdu");
            INSERT INTO languages (description) VALUES ( "Turkish");
            INSERT INTO languages (description) VALUES ( "Italian");
            INSERT INTO languages (description) VALUES ( "Yue (Cantonese)");
            INSERT INTO languages (description) VALUES ( "Thai");
            INSERT INTO languages (description) VALUES ( "Gujarati");
            INSERT INTO languages (description) VALUES ( "Jin");
            INSERT INTO languages (description) VALUES ( "Southern Min");
            INSERT INTO languages (description) VALUES ( "Persian");
            INSERT INTO languages (description) VALUES ( "Polish");
            INSERT INTO languages (description) VALUES ( "Pashto");
            INSERT INTO languages (description) VALUES ( "Kannada");
            INSERT INTO languages (description) VALUES ( "Xiang (Hunnanese)");
            INSERT INTO languages (description) VALUES ( "Malayalam");
            INSERT INTO languages (description) VALUES ( "Sundanese");
            INSERT INTO languages (description) VALUES ( "Hausa");
            INSERT INTO languages (description) VALUES ( "Odia (Oriya)");
            INSERT INTO languages (description) VALUES ( "Burmese");
            INSERT INTO languages (description) VALUES ( "Hakka");
            INSERT INTO languages (description) VALUES ( "Ukrainian");
            INSERT INTO languages (description) VALUES ( "Bhojpuri");
            INSERT INTO languages (description) VALUES ( "Tagalog");
            INSERT INTO languages (description) VALUES ( "Yoruba");
            INSERT INTO languages (description) VALUES ( "Maithili");
            INSERT INTO languages (description) VALUES ( "Uzbek");
            INSERT INTO languages (description) VALUES ( "Sindhi");
            INSERT INTO languages (description) VALUES ( "Amharic");
            INSERT INTO languages (description) VALUES ( "Fula");
            INSERT INTO languages (description) VALUES ( "Romanian");
            INSERT INTO languages (description) VALUES ( "Oromo");
            INSERT INTO languages (description) VALUES ( "Igbo");
            INSERT INTO languages (description) VALUES ( "Azerbaijani");
            INSERT INTO languages (description) VALUES ( "Awadhi");
            INSERT INTO languages (description) VALUES ( "Gan Chinese");
            INSERT INTO languages (description) VALUES ( "Cebuano (Visayan)");
            INSERT INTO languages (description) VALUES ( "Dutch");
            INSERT INTO languages (description) VALUES ( "Kurdish");
            INSERT INTO languages (description) VALUES ( "Serbo-Croatian");
            INSERT INTO languages (description) VALUES ( "Malagasy");
            INSERT INTO languages (description) VALUES ( "Saraiki");
            INSERT INTO languages (description) VALUES ( "Nepali");
            INSERT INTO languages (description) VALUES ( "Sinhalese");
            INSERT INTO languages (description) VALUES ( "Chittagonian");
            INSERT INTO languages (description) VALUES ( "Zhuang");
            INSERT INTO languages (description) VALUES ( "Khmer");
            INSERT INTO languages (description) VALUES ( "Turkmen");
            INSERT INTO languages (description) VALUES ( "Assamese");
            INSERT INTO languages (description) VALUES ( "Madurese");
            INSERT INTO languages (description) VALUES ( "Somali");
            INSERT INTO languages (description) VALUES ( "Marwari");
            INSERT INTO languages (description) VALUES ( "Magahi");
            INSERT INTO languages (description) VALUES ( "Haryanvi");
            INSERT INTO languages (description) VALUES ( "Hungarian");
            INSERT INTO languages (description) VALUES ( "Chhattisgarhi");
            INSERT INTO languages (description) VALUES ( "Greek");
            INSERT INTO languages (description) VALUES ( "Chewa");
            INSERT INTO languages (description) VALUES ( "Deccan");
            INSERT INTO languages (description) VALUES ( "Akan");
            INSERT INTO languages (description) VALUES ( "Kazakh");
            INSERT INTO languages (description) VALUES ( "Northern Min");
            INSERT INTO languages (description) VALUES ( "Sylheti");
            INSERT INTO languages (description) VALUES ( "Zulu");
            INSERT INTO languages (description) VALUES ( "Czech");
            INSERT INTO languages (description) VALUES ( "Kinyarwanda");
            INSERT INTO languages (description) VALUES ( "Dhundhari");
            INSERT INTO languages (description) VALUES ( "Haitian Creole");
            INSERT INTO languages (description) VALUES ( "Eastern Min");
            INSERT INTO languages (description) VALUES ( "Ilocano");
            INSERT INTO languages (description) VALUES ( "Quechua");
            INSERT INTO languages (description) VALUES ( "Kirundi");
            INSERT INTO languages (description) VALUES ( "Swedish");
            INSERT INTO languages (description) VALUES ( "Hmong");
            INSERT INTO languages (description) VALUES ( "Shona");
            INSERT INTO languages (description) VALUES ( "Uyghur");
            INSERT INTO languages (description) VALUES ( "Hiligaynon");
            INSERT INTO languages (description) VALUES ( "Mossi");
            INSERT INTO languages (description) VALUES ( "Xhosa");
            INSERT INTO languages (description) VALUES ( "Belarusian");
            INSERT INTO languages (description) VALUES ( "Balochi");
            INSERT INTO languages (description) VALUES ( "Konkani");
        ');
    }
}
