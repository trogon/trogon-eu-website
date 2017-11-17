<?php

use yii\db\Schema;
use yii\db\Migration;

class m140810_010001_country_data extends Migration
{
    public function safeUp() // 249 countries
	{
		$this->insert('{{%country}}', [
			'code' => 'AD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Andorra',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AE', 'language' => 'ar-AE', 'currency' => 'PLN',
			'name' => 'United Arab Emirates',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Afghanistan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Antigua and Barbuda',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AI', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Anguilla',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AL', 'language' => 'sq-AL', 'currency' => 'PLN',
			'name' => 'Albania',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AM', 'language' => 'hy-AM', 'currency' => 'PLN',
			'name' => 'Armenia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AO', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Angola',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AQ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Antarctica',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AR', 'language' => 'es-AR', 'currency' => 'PLN',
			'name' => 'Argentina',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'American Samoa',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AT', 'language' => 'de-AT', 'currency' => 'PLN',
			'name' => 'Austria',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AU', 'language' => 'en-AU', 'currency' => 'PLN',
			'name' => 'Australia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Aruba',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AX', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Åland Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'AZ', 'language' => 'az-AZ', 'currency' => 'PLN',
			'name' => 'Azerbaijan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BA', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bosnia and Herzegovina',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BB', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Barbados',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bangladesh',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BE', 'language' => 'nl-BE;fr-BE', 'currency' => 'PLN',
			'name' => 'Belgium',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Burkina Faso',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BG', 'language' => 'bg-BG', 'currency' => 'PLN',
			'name' => 'Bulgaria',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BH', 'language' => 'ar-BH', 'currency' => 'PLN',
			'name' => 'Bahrain',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BI', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Burundi',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BJ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Benin',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BL', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Barthélemy',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bermuda',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BN', 'language' => 'ms-BN', 'currency' => 'PLN',
			'name' => 'Brunei Darussalam',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BO', 'language' => 'es-BO', 'currency' => 'PLN',
			'name' => 'Bolivia, Plurinational State of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BQ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bonaire, Sint Eustatius and Saba',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BR', 'language' => 'pt-BR', 'currency' => 'PLN',
			'name' => 'Brazil',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bahamas',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BT', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bhutan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BV', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Bouvet Island',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Botswana',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BY', 'language' => 'be-BY', 'currency' => 'PLN',
			'name' => 'Belarus',
		]);
		$this->insert('{{%country}}', [
			'code' => 'BZ', 'language' => 'en-BZ', 'currency' => 'PLN',
			'name' => 'Belize',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CA', 'language' => 'en-CA;fr-CA', 'currency' => 'PLN',
			'name' => 'Canada',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CC', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cocos (Keeling) Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Congo, the Democratic Republic of the',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Central African Republic',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Congo',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CH', 'language' => 'fr-CH;de-CH;it-CH', 'currency' => 'PLN',
			'name' => 'Switzerland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CI', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Côte d\'Ivoire',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CK', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cook Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CL', 'language' => 'es-CL', 'currency' => 'PLN',
			'name' => 'Chile',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cameroon',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CN', 'language' => 'zh-CN', 'currency' => 'PLN',
			'name' => 'China',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CO', 'language' => 'es-CO', 'currency' => 'PLN',
			'name' => 'Colombia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CR', 'language' => 'es-CR', 'currency' => 'PLN',
			'name' => 'Costa Rica',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CU', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cuba',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CV', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cabo Verde',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Curaçao',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CX', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Christmas Island',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CY', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cyprus',
		]);
		$this->insert('{{%country}}', [
			'code' => 'CZ', 'language' => 'cs-CZ', 'currency' => 'PLN',
			'name' => 'Czech Republic',
		]);
		$this->insert('{{%country}}', [
			'code' => 'DE', 'language' => 'de-DE', 'currency' => 'PLN',
			'name' => 'Germany',
		]);
		$this->insert('{{%country}}', [
			'code' => 'DJ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Djibouti',
		]);
		$this->insert('{{%country}}', [
			'code' => 'DK', 'language' => 'da-DK', 'currency' => 'PLN',
			'name' => 'Denmark',
		]);
		$this->insert('{{%country}}', [
			'code' => 'DM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Dominica',
		]);
		$this->insert('{{%country}}', [
			'code' => 'DO', 'language' => 'es-DO', 'currency' => 'PLN',
			'name' => 'Dominican Republic',
		]);
		$this->insert('{{%country}}', [
			'code' => 'DZ', 'language' => 'ar-DZ', 'currency' => 'PLN',
			'name' => 'Algeria',
		]);
		$this->insert('{{%country}}', [
			'code' => 'EC', 'language' => 'es-EC', 'currency' => 'PLN',
			'name' => 'Ecuador',
		]);
		$this->insert('{{%country}}', [
			'code' => 'EE', 'language' => 'et-EE', 'currency' => 'PLN',
			'name' => 'Estonia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'EG', 'language' => 'ar-EG', 'currency' => 'PLN',
			'name' => 'Egypt',
		]);
		$this->insert('{{%country}}', [
			'code' => 'EH', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Western Sahara',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ER', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Eritrea',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ES', 'language' => 'es-ES;eu-ES;gl-ES', 'currency' => 'PLN',
			'name' => 'Spain',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ET', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Ethiopia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'FI', 'language' => 'fi-FI;sv-FI', 'currency' => 'PLN',
			'name' => 'Finland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'FJ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Fiji',
		]);
		$this->insert('{{%country}}', [
			'code' => 'FK', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Falkland Islands (Malvinas)',
		]);
		$this->insert('{{%country}}', [
			'code' => 'FM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Micronesia, Federated States of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'FO', 'language' => 'fo-FO', 'currency' => 'PLN',
			'name' => 'Faroe Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'FR', 'language' => 'fr-FR', 'currency' => 'PLN',
			'name' => 'France',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GA', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Gabon',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GB', 'language' => 'en-GB', 'currency' => 'PLN',
			'name' => 'United Kingdom of Great Britain and Northern Ireland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Grenada',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GE', 'language' => 'ka-GE', 'currency' => 'PLN',
			'name' => 'Georgia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'French Guiana',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Guernsey',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GH', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Ghana',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GI', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Gibraltar',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GL', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Greenland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Gambia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GN', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Guinea',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GP', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Guadeloupe',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GQ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Equatorial Guinea',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GR', 'language' => 'el-GR', 'currency' => 'PLN',
			'name' => 'Greece',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'South Georgia and the South Sandwich Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GT', 'language' => 'es-GT', 'currency' => 'PLN',
			'name' => 'Guatemala',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GU', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Guam',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Guinea-Bissau',
		]);
		$this->insert('{{%country}}', [
			'code' => 'GY', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Guyana',
		]);
		$this->insert('{{%country}}', [
			'code' => 'HK', 'language' => 'zh-HK', 'currency' => 'PLN',
			'name' => 'Hong Kong',
		]);
		$this->insert('{{%country}}', [
			'code' => 'HM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Heard Island and McDonald Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'HN', 'language' => 'es-HN', 'currency' => 'PLN',
			'name' => 'Honduras',
		]);
		$this->insert('{{%country}}', [
			'code' => 'HR', 'language' => 'hr-HR', 'currency' => 'PLN',
			'name' => 'Croatia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'HT', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Haiti',
		]);
		$this->insert('{{%country}}', [
			'code' => 'HU', 'language' => 'hu-HU', 'currency' => 'PLN',
			'name' => 'Hungary',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ID', 'language' => 'id-ID', 'currency' => 'PLN',
			'name' => 'Indonesia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IE', 'language' => 'en-IE', 'currency' => 'PLN',
			'name' => 'Ireland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IL', 'language' => 'he-IL', 'currency' => 'PLN',
			'name' => 'Israel',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Isle of Man',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IN', 'language' => 'gu-IN;hi-IN;kn-IN;kok-IN;mr-IN;pa-IN;sa-IN;ta-IN;te-IN', 'currency' => 'PLN',
			'name' => 'India',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IO', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'British Indian Ocean Territory',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IQ', 'language' => 'ar-IQ', 'currency' => 'PLN',
			'name' => 'Iraq',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IR', 'language' => 'fa-IR', 'currency' => 'PLN',
			'name' => 'Iran, Islamic Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IS', 'language' => 'is-IS', 'currency' => 'PLN',
			'name' => 'Iceland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'IT', 'language' => 'it-IT', 'currency' => 'PLN',
			'name' => 'Italy',
		]);
		$this->insert('{{%country}}', [
			'code' => 'JE', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Jersey',
		]);
		$this->insert('{{%country}}', [
			'code' => 'JM', 'language' => 'en-JM', 'currency' => 'PLN',
			'name' => 'Jamaica',
		]);
		$this->insert('{{%country}}', [
			'code' => 'JO', 'language' => 'ar-JO', 'currency' => 'PLN',
			'name' => 'Jordan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'JP', 'language' => 'ja-JP', 'currency' => 'PLN',
			'name' => 'Japan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KE', 'language' => 'sw-KE', 'currency' => 'PLN',
			'name' => 'Kenya',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Kyrgyzstan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KH', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cambodia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KI', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Kiribati',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Comoros',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KN', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Kitts and Nevis',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KP', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Korea, Democratic People\'s Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KR', 'language' => 'ko-KR', 'currency' => 'PLN',
			'name' => 'Korea, Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KW', 'language' => 'ar-KW', 'currency' => 'PLN',
			'name' => 'Kuwait',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KY', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Cayman Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'KZ', 'language' => 'kk-KZ;ky-KZ', 'currency' => 'PLN',
			'name' => 'Kazakhstan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LA', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Lao People\'s Democratic Republic',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LB', 'language' => 'ar-LB', 'currency' => 'PLN',
			'name' => 'Lebanon',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LC', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Lucia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LI', 'language' => 'de-LI', 'currency' => 'PLN',
			'name' => 'Liechtenstein',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LK', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Sri Lanka',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LR', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Liberia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Lesotho',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LT', 'language' => 'lt-LT', 'currency' => 'PLN',
			'name' => 'Lithuania',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LU', 'language' => 'fr-LU;de-LU', 'currency' => 'PLN',
			'name' => 'Luxembourg',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LV', 'language' => 'lv-LV', 'currency' => 'PLN',
			'name' => 'Latvia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'LY', 'language' => 'ar-LY', 'currency' => 'PLN',
			'name' => 'Libya',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MA', 'language' => 'ar-MA', 'currency' => 'PLN',
			'name' => 'Morocco',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MC', 'language' => 'fr-MC', 'currency' => 'PLN',
			'name' => 'Monaco',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Moldova, Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ME', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Montenegro',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Martin (French part)',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Madagascar',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MH', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Marshall Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MK', 'language' => 'mk-MK', 'currency' => 'PLN',
			'name' => 'Macedonia, the former Yugoslav Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ML', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Mali',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Myanmar',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MN', 'language' => 'mn-MN', 'currency' => 'PLN',
			'name' => 'Mongolia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MO', 'language' => 'zh-MO', 'currency' => 'PLN',
			'name' => 'Macao',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MP', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Northern Mariana Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MQ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Martinique',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MR', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Mauritania',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Montserrat',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MT', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Malta',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MU', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Mauritius',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MV', 'language' => 'div-MV', 'currency' => 'PLN',
			'name' => 'Maldives',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Malawi',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MX', 'language' => 'es-MX', 'currency' => 'PLN',
			'name' => 'Mexico',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MY', 'language' => 'ms-MY', 'currency' => 'PLN',
			'name' => 'Malaysia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'MZ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Mozambique',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NA', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Namibia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NC', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'New Caledonia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NE', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Niger',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Norfolk Island',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Nigeria',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NI', 'language' => 'es-NI', 'currency' => 'PLN',
			'name' => 'Nicaragua',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NL', 'language' => 'nl-NL', 'currency' => 'PLN',
			'name' => 'Netherlands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NO', 'language' => 'nb-NO;nn-NO', 'currency' => 'PLN',
			'name' => 'Norway',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NP', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Nepal',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NR', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Nauru',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NU', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Niue',
		]);
		$this->insert('{{%country}}', [
			'code' => 'NZ', 'language' => 'en-NZ', 'currency' => 'PLN',
			'name' => 'New Zealand',
		]);
		$this->insert('{{%country}}', [
			'code' => 'OM', 'language' => 'ar-OM', 'currency' => 'PLN',
			'name' => 'Oman',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PA', 'language' => 'es-PA', 'currency' => 'PLN',
			'name' => 'Panama',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PE', 'language' => 'es-PE', 'currency' => 'PLN',
			'name' => 'Peru',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'French Polynesia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Papua New Guinea',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PH', 'language' => 'en-PH', 'currency' => 'PLN',
			'name' => 'Philippines',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PK', 'language' => 'ur-PK', 'currency' => 'PLN',
			'name' => 'Pakistan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PL', 'language' => 'pl-PL', 'currency' => 'PLN',
			'name' => 'Poland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Pierre and Miquelon',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PN', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Pitcairn',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PR', 'language' => 'es-PR', 'currency' => 'PLN',
			'name' => 'Puerto Rico',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Palestine, State of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PT', 'language' => 'pt-PT', 'currency' => 'PLN',
			'name' => 'Portugal',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Palau',
		]);
		$this->insert('{{%country}}', [
			'code' => 'PY', 'language' => 'es-PY', 'currency' => 'PLN',
			'name' => 'Paraguay',
		]);
		$this->insert('{{%country}}', [
			'code' => 'QA', 'language' => 'ar-QA', 'currency' => 'PLN',
			'name' => 'Qatar',
		]);
		$this->insert('{{%country}}', [
			'code' => 'RE', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Réunion',
		]);
		$this->insert('{{%country}}', [
			'code' => 'RO', 'language' => 'ro-RO', 'currency' => 'PLN',
			'name' => 'Romania',
		]);
		$this->insert('{{%country}}', [
			'code' => 'RS', 'language' => 'sr-SP', 'currency' => 'PLN',
			'name' => 'Serbia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'RU', 'language' => 'ru-RU;tt-RU', 'currency' => 'PLN',
			'name' => 'Russian Federation',
		]);
		$this->insert('{{%country}}', [
			'code' => 'RW', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Rwanda',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SA', 'language' => 'ar-SA', 'currency' => 'PLN',
			'name' => 'Saudi Arabia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SB', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Solomon Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SC', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Seychelles',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Sudan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SE', 'language' => 'sv-SE', 'currency' => 'PLN',
			'name' => 'Sweden',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SG', 'language' => 'zh-SG', 'currency' => 'PLN',
			'name' => 'Singapore',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SH', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Helena, Ascension and Tristan da Cunha',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SI', 'language' => 'sl-SI', 'currency' => 'PLN',
			'name' => 'Slovenia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SJ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Svalbard and Jan Mayen',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SK', 'language' => 'sk-SK', 'currency' => 'PLN',
			'name' => 'Slovakia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SL', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Sierra Leone',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'San Marino',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SN', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Senegal',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SO', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Somalia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SR', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Suriname',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'South Sudan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ST', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Sao Tome and Principe',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SV', 'language' => 'es-SV', 'currency' => 'PLN',
			'name' => 'El Salvador',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SX', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Sint Maarten (Dutch part)',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SY', 'language' => 'syr-SY;ar-SY', 'currency' => 'PLN',
			'name' => 'Syrian Arab Republic',
		]);
		$this->insert('{{%country}}', [
			'code' => 'SZ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Swaziland',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TC', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Turks and Caicos Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TD', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Chad',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'French Southern Territories',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Togo',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TH', 'language' => 'th-TH', 'currency' => 'PLN',
			'name' => 'Thailand',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TJ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Tajikistan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TK', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Tokelau',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TL', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Timor-Leste',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Turkmenistan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TN', 'language' => 'ar-TN', 'currency' => 'PLN',
			'name' => 'Tunisia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TO', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Tonga',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TR', 'language' => 'tr-TR', 'currency' => 'PLN',
			'name' => 'Turkey',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TT', 'language' => 'en-TT', 'currency' => 'PLN',
			'name' => 'Trinidad and Tobago',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TV', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Tuvalu',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TW', 'language' => 'zh-TW', 'currency' => 'PLN',
			'name' => 'Taiwan, Province of China',
		]);
		$this->insert('{{%country}}', [
			'code' => 'TZ', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Tanzania, United Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'UA', 'language' => 'uk-UA', 'currency' => 'PLN',
			'name' => 'Ukraine',
		]);
		$this->insert('{{%country}}', [
			'code' => 'UG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Uganda',
		]);
		$this->insert('{{%country}}', [
			'code' => 'UM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'United States Minor Outlying Islands',
		]);
		$this->insert('{{%country}}', [
			'code' => 'US', 'language' => 'en-US', 'currency' => 'PLN',
			'name' => 'United States of America',
		]);
		$this->insert('{{%country}}', [
			'code' => 'UY', 'language' => 'es-UY', 'currency' => 'PLN',
			'name' => 'Uruguay',
		]);
		$this->insert('{{%country}}', [
			'code' => 'UZ', 'language' => 'uz-UZ', 'currency' => 'PLN',
			'name' => 'Uzbekistan',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VA', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Holy See',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VC', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Saint Vincent and the Grenadines',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VE', 'language' => 'es-VE', 'currency' => 'PLN',
			'name' => 'Venezuela, Bolivarian Republic of',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VG', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Virgin Islands, British',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VI', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Virgin Islands, U.S.',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VN', 'language' => 'vi-VN', 'currency' => 'PLN',
			'name' => 'Viet Nam',
		]);
		$this->insert('{{%country}}', [
			'code' => 'VU', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Vanuatu',
		]);
		$this->insert('{{%country}}', [
			'code' => 'WF', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Wallis and Futuna',
		]);
		$this->insert('{{%country}}', [
			'code' => 'WS', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Samoa',
		]);
		$this->insert('{{%country}}', [
			'code' => 'YE', 'language' => 'ar-YE', 'currency' => 'PLN',
			'name' => 'Yemen',
		]);
		$this->insert('{{%country}}', [
			'code' => 'YT', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Mayotte',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ZA', 'language' => 'af-ZA', 'currency' => 'PLN',
			'name' => 'South Africa',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ZM', 'language' => 'pl', 'currency' => 'PLN',
			'name' => 'Zambia',
		]);
		$this->insert('{{%country}}', [
			'code' => 'ZW', 'language' => 'en-ZW', 'currency' => 'PLN',
			'name' => 'Zimbabwe',
		]);
	}

	public function safeDown()
	{
		$this->delete('{{%country}}', ['code' => 'AD']);
		$this->delete('{{%country}}', ['code' => 'AE']);
		$this->delete('{{%country}}', ['code' => 'AF']);
		$this->delete('{{%country}}', ['code' => 'AG']);
		$this->delete('{{%country}}', ['code' => 'AI']);
		$this->delete('{{%country}}', ['code' => 'AL']);
		$this->delete('{{%country}}', ['code' => 'AM']);
		$this->delete('{{%country}}', ['code' => 'AO']);
		$this->delete('{{%country}}', ['code' => 'AQ']);
		$this->delete('{{%country}}', ['code' => 'AR']);
		$this->delete('{{%country}}', ['code' => 'AS']);
		$this->delete('{{%country}}', ['code' => 'AT']);
		$this->delete('{{%country}}', ['code' => 'AU']);
		$this->delete('{{%country}}', ['code' => 'AW']);
		$this->delete('{{%country}}', ['code' => 'AX']);
		$this->delete('{{%country}}', ['code' => 'AZ']);
		$this->delete('{{%country}}', ['code' => 'BA']);
		$this->delete('{{%country}}', ['code' => 'BB']);
		$this->delete('{{%country}}', ['code' => 'BD']);
		$this->delete('{{%country}}', ['code' => 'BE']);
		$this->delete('{{%country}}', ['code' => 'BF']);
		$this->delete('{{%country}}', ['code' => 'BG']);
		$this->delete('{{%country}}', ['code' => 'BH']);
		$this->delete('{{%country}}', ['code' => 'BI']);
		$this->delete('{{%country}}', ['code' => 'BJ']);
		$this->delete('{{%country}}', ['code' => 'BL']);
		$this->delete('{{%country}}', ['code' => 'BM']);
		$this->delete('{{%country}}', ['code' => 'BN']);
		$this->delete('{{%country}}', ['code' => 'BO']);
		$this->delete('{{%country}}', ['code' => 'BQ']);
		$this->delete('{{%country}}', ['code' => 'BR']);
		$this->delete('{{%country}}', ['code' => 'BS']);
		$this->delete('{{%country}}', ['code' => 'BT']);
		$this->delete('{{%country}}', ['code' => 'BV']);
		$this->delete('{{%country}}', ['code' => 'BW']);
		$this->delete('{{%country}}', ['code' => 'BY']);
		$this->delete('{{%country}}', ['code' => 'BZ']);
		$this->delete('{{%country}}', ['code' => 'CA']);
		$this->delete('{{%country}}', ['code' => 'CC']);
		$this->delete('{{%country}}', ['code' => 'CD']);
		$this->delete('{{%country}}', ['code' => 'CF']);
		$this->delete('{{%country}}', ['code' => 'CG']);
		$this->delete('{{%country}}', ['code' => 'CH']);
		$this->delete('{{%country}}', ['code' => 'CI']);
		$this->delete('{{%country}}', ['code' => 'CK']);
		$this->delete('{{%country}}', ['code' => 'CL']);
		$this->delete('{{%country}}', ['code' => 'CM']);
		$this->delete('{{%country}}', ['code' => 'CN']);
		$this->delete('{{%country}}', ['code' => 'CO']);
		$this->delete('{{%country}}', ['code' => 'CR']);
		$this->delete('{{%country}}', ['code' => 'CU']);
		$this->delete('{{%country}}', ['code' => 'CV']);
		$this->delete('{{%country}}', ['code' => 'CW']);
		$this->delete('{{%country}}', ['code' => 'CX']);
		$this->delete('{{%country}}', ['code' => 'CY']);
		$this->delete('{{%country}}', ['code' => 'CZ']);
		$this->delete('{{%country}}', ['code' => 'DE']);
		$this->delete('{{%country}}', ['code' => 'DJ']);
		$this->delete('{{%country}}', ['code' => 'DK']);
		$this->delete('{{%country}}', ['code' => 'DM']);
		$this->delete('{{%country}}', ['code' => 'DO']);
		$this->delete('{{%country}}', ['code' => 'DZ']);
		$this->delete('{{%country}}', ['code' => 'EC']);
		$this->delete('{{%country}}', ['code' => 'EE']);
		$this->delete('{{%country}}', ['code' => 'EG']);
		$this->delete('{{%country}}', ['code' => 'EH']);
		$this->delete('{{%country}}', ['code' => 'ER']);
		$this->delete('{{%country}}', ['code' => 'ES']);
		$this->delete('{{%country}}', ['code' => 'ET']);
		$this->delete('{{%country}}', ['code' => 'FI']);
		$this->delete('{{%country}}', ['code' => 'FJ']);
		$this->delete('{{%country}}', ['code' => 'FK']);
		$this->delete('{{%country}}', ['code' => 'FM']);
		$this->delete('{{%country}}', ['code' => 'FO']);
		$this->delete('{{%country}}', ['code' => 'FR']);
		$this->delete('{{%country}}', ['code' => 'GA']);
		$this->delete('{{%country}}', ['code' => 'GB']);
		$this->delete('{{%country}}', ['code' => 'GD']);
		$this->delete('{{%country}}', ['code' => 'GE']);
		$this->delete('{{%country}}', ['code' => 'GF']);
		$this->delete('{{%country}}', ['code' => 'GG']);
		$this->delete('{{%country}}', ['code' => 'GH']);
		$this->delete('{{%country}}', ['code' => 'GI']);
		$this->delete('{{%country}}', ['code' => 'GL']);
		$this->delete('{{%country}}', ['code' => 'GM']);
		$this->delete('{{%country}}', ['code' => 'GN']);
		$this->delete('{{%country}}', ['code' => 'GP']);
		$this->delete('{{%country}}', ['code' => 'GQ']);
		$this->delete('{{%country}}', ['code' => 'GR']);
		$this->delete('{{%country}}', ['code' => 'GS']);
		$this->delete('{{%country}}', ['code' => 'GT']);
		$this->delete('{{%country}}', ['code' => 'GU']);
		$this->delete('{{%country}}', ['code' => 'GW']);
		$this->delete('{{%country}}', ['code' => 'GY']);
		$this->delete('{{%country}}', ['code' => 'HK']);
		$this->delete('{{%country}}', ['code' => 'HM']);
		$this->delete('{{%country}}', ['code' => 'HN']);
		$this->delete('{{%country}}', ['code' => 'HR']);
		$this->delete('{{%country}}', ['code' => 'HT']);
		$this->delete('{{%country}}', ['code' => 'HU']);
		$this->delete('{{%country}}', ['code' => 'ID']);
		$this->delete('{{%country}}', ['code' => 'IE']);
		$this->delete('{{%country}}', ['code' => 'IL']);
		$this->delete('{{%country}}', ['code' => 'IM']);
		$this->delete('{{%country}}', ['code' => 'IN']);
		$this->delete('{{%country}}', ['code' => 'IO']);
		$this->delete('{{%country}}', ['code' => 'IQ']);
		$this->delete('{{%country}}', ['code' => 'IR']);
		$this->delete('{{%country}}', ['code' => 'IS']);
		$this->delete('{{%country}}', ['code' => 'IT']);
		$this->delete('{{%country}}', ['code' => 'JE']);
		$this->delete('{{%country}}', ['code' => 'JM']);
		$this->delete('{{%country}}', ['code' => 'JO']);
		$this->delete('{{%country}}', ['code' => 'JP']);
		$this->delete('{{%country}}', ['code' => 'KE']);
		$this->delete('{{%country}}', ['code' => 'KG']);
		$this->delete('{{%country}}', ['code' => 'KH']);
		$this->delete('{{%country}}', ['code' => 'KI']);
		$this->delete('{{%country}}', ['code' => 'KM']);
		$this->delete('{{%country}}', ['code' => 'KN']);
		$this->delete('{{%country}}', ['code' => 'KP']);
		$this->delete('{{%country}}', ['code' => 'KR']);
		$this->delete('{{%country}}', ['code' => 'KW']);
		$this->delete('{{%country}}', ['code' => 'KY']);
		$this->delete('{{%country}}', ['code' => 'KZ']);
		$this->delete('{{%country}}', ['code' => 'LA']);
		$this->delete('{{%country}}', ['code' => 'LB']);
		$this->delete('{{%country}}', ['code' => 'LC']);
		$this->delete('{{%country}}', ['code' => 'LI']);
		$this->delete('{{%country}}', ['code' => 'LK']);
		$this->delete('{{%country}}', ['code' => 'LR']);
		$this->delete('{{%country}}', ['code' => 'LS']);
		$this->delete('{{%country}}', ['code' => 'LT']);
		$this->delete('{{%country}}', ['code' => 'LU']);
		$this->delete('{{%country}}', ['code' => 'LV']);
		$this->delete('{{%country}}', ['code' => 'LY']);
		$this->delete('{{%country}}', ['code' => 'MA']);
		$this->delete('{{%country}}', ['code' => 'MC']);
		$this->delete('{{%country}}', ['code' => 'MD']);
		$this->delete('{{%country}}', ['code' => 'ME']);
		$this->delete('{{%country}}', ['code' => 'MF']);
		$this->delete('{{%country}}', ['code' => 'MG']);
		$this->delete('{{%country}}', ['code' => 'MH']);
		$this->delete('{{%country}}', ['code' => 'MK']);
		$this->delete('{{%country}}', ['code' => 'ML']);
		$this->delete('{{%country}}', ['code' => 'MM']);
		$this->delete('{{%country}}', ['code' => 'MN']);
		$this->delete('{{%country}}', ['code' => 'MO']);
		$this->delete('{{%country}}', ['code' => 'MP']);
		$this->delete('{{%country}}', ['code' => 'MQ']);
		$this->delete('{{%country}}', ['code' => 'MR']);
		$this->delete('{{%country}}', ['code' => 'MS']);
		$this->delete('{{%country}}', ['code' => 'MT']);
		$this->delete('{{%country}}', ['code' => 'MU']);
		$this->delete('{{%country}}', ['code' => 'MV']);
		$this->delete('{{%country}}', ['code' => 'MW']);
		$this->delete('{{%country}}', ['code' => 'MX']);
		$this->delete('{{%country}}', ['code' => 'MY']);
		$this->delete('{{%country}}', ['code' => 'MZ']);
		$this->delete('{{%country}}', ['code' => 'NA']);
		$this->delete('{{%country}}', ['code' => 'NC']);
		$this->delete('{{%country}}', ['code' => 'NE']);
		$this->delete('{{%country}}', ['code' => 'NF']);
		$this->delete('{{%country}}', ['code' => 'NG']);
		$this->delete('{{%country}}', ['code' => 'NI']);
		$this->delete('{{%country}}', ['code' => 'NL']);
		$this->delete('{{%country}}', ['code' => 'NO']);
		$this->delete('{{%country}}', ['code' => 'NP']);
		$this->delete('{{%country}}', ['code' => 'NR']);
		$this->delete('{{%country}}', ['code' => 'NU']);
		$this->delete('{{%country}}', ['code' => 'NZ']);
		$this->delete('{{%country}}', ['code' => 'OM']);
		$this->delete('{{%country}}', ['code' => 'PA']);
		$this->delete('{{%country}}', ['code' => 'PE']);
		$this->delete('{{%country}}', ['code' => 'PF']);
		$this->delete('{{%country}}', ['code' => 'PG']);
		$this->delete('{{%country}}', ['code' => 'PH']);
		$this->delete('{{%country}}', ['code' => 'PK']);
		$this->delete('{{%country}}', ['code' => 'PL']);
		$this->delete('{{%country}}', ['code' => 'PM']);
		$this->delete('{{%country}}', ['code' => 'PN']);
		$this->delete('{{%country}}', ['code' => 'PR']);
		$this->delete('{{%country}}', ['code' => 'PS']);
		$this->delete('{{%country}}', ['code' => 'PT']);
		$this->delete('{{%country}}', ['code' => 'PW']);
		$this->delete('{{%country}}', ['code' => 'PY']);
		$this->delete('{{%country}}', ['code' => 'QA']);
		$this->delete('{{%country}}', ['code' => 'RE']);
		$this->delete('{{%country}}', ['code' => 'RO']);
		$this->delete('{{%country}}', ['code' => 'RS']);
		$this->delete('{{%country}}', ['code' => 'RU']);
		$this->delete('{{%country}}', ['code' => 'RW']);
		$this->delete('{{%country}}', ['code' => 'SA']);
		$this->delete('{{%country}}', ['code' => 'SB']);
		$this->delete('{{%country}}', ['code' => 'SC']);
		$this->delete('{{%country}}', ['code' => 'SD']);
		$this->delete('{{%country}}', ['code' => 'SE']);
		$this->delete('{{%country}}', ['code' => 'SG']);
		$this->delete('{{%country}}', ['code' => 'SH']);
		$this->delete('{{%country}}', ['code' => 'SI']);
		$this->delete('{{%country}}', ['code' => 'SJ']);
		$this->delete('{{%country}}', ['code' => 'SK']);
		$this->delete('{{%country}}', ['code' => 'SL']);
		$this->delete('{{%country}}', ['code' => 'SM']);
		$this->delete('{{%country}}', ['code' => 'SN']);
		$this->delete('{{%country}}', ['code' => 'SO']);
		$this->delete('{{%country}}', ['code' => 'SR']);
		$this->delete('{{%country}}', ['code' => 'SS']);
		$this->delete('{{%country}}', ['code' => 'ST']);
		$this->delete('{{%country}}', ['code' => 'SV']);
		$this->delete('{{%country}}', ['code' => 'SX']);
		$this->delete('{{%country}}', ['code' => 'SY']);
		$this->delete('{{%country}}', ['code' => 'SZ']);
		$this->delete('{{%country}}', ['code' => 'TC']);
		$this->delete('{{%country}}', ['code' => 'TD']);
		$this->delete('{{%country}}', ['code' => 'TF']);
		$this->delete('{{%country}}', ['code' => 'TG']);
		$this->delete('{{%country}}', ['code' => 'TH']);
		$this->delete('{{%country}}', ['code' => 'TJ']);
		$this->delete('{{%country}}', ['code' => 'TK']);
		$this->delete('{{%country}}', ['code' => 'TL']);
		$this->delete('{{%country}}', ['code' => 'TM']);
		$this->delete('{{%country}}', ['code' => 'TN']);
		$this->delete('{{%country}}', ['code' => 'TO']);
		$this->delete('{{%country}}', ['code' => 'TR']);
		$this->delete('{{%country}}', ['code' => 'TT']);
		$this->delete('{{%country}}', ['code' => 'TV']);
		$this->delete('{{%country}}', ['code' => 'TW']);
		$this->delete('{{%country}}', ['code' => 'TZ']);
		$this->delete('{{%country}}', ['code' => 'UA']);
		$this->delete('{{%country}}', ['code' => 'UG']);
		$this->delete('{{%country}}', ['code' => 'UM']);
		$this->delete('{{%country}}', ['code' => 'US']);
		$this->delete('{{%country}}', ['code' => 'UY']);
		$this->delete('{{%country}}', ['code' => 'UZ']);
		$this->delete('{{%country}}', ['code' => 'VA']);
		$this->delete('{{%country}}', ['code' => 'VC']);
		$this->delete('{{%country}}', ['code' => 'VE']);
		$this->delete('{{%country}}', ['code' => 'VG']);
		$this->delete('{{%country}}', ['code' => 'VI']);
		$this->delete('{{%country}}', ['code' => 'VN']);
		$this->delete('{{%country}}', ['code' => 'VU']);
		$this->delete('{{%country}}', ['code' => 'WF']);
		$this->delete('{{%country}}', ['code' => 'WS']);
		$this->delete('{{%country}}', ['code' => 'YE']);
		$this->delete('{{%country}}', ['code' => 'YT']);
		$this->delete('{{%country}}', ['code' => 'ZA']);
		$this->delete('{{%country}}', ['code' => 'ZM']);
		$this->delete('{{%country}}', ['code' => 'ZW']);
	}
}
