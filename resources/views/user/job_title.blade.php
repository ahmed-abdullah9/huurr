
<script>
var country_arr = new Array("Afghanistan", "Albania", "+", "American Samoa", "Angola", "Anguilla", "Antartica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Ashmore and Cartier Island", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Clipperton Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czeck Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Europa Island", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "Antarctic Lands", "Gabon", "Gambia, The", "Gaza Strip", "Georgia", "Germany", "Ghana", "Gibraltar", "Glorioso Islands", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island", "Holy See (Vatican City)", "Honduras", "Hong Kong", "Howland Island", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Ireland, Northern", "Israel", "Italy", "Jamaica", "Jan Mayen", "Japan", "Jarvis Island", "Jersey", "Johnston Atoll", "Jordan", "Juan de Nova Island", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Man, Isle of", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia", "Midway Islands", "Moldova", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcaim Islands", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romainia", "Russia", "Rwanda", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Scotland", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "Spain", "Spratly Islands", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Tobago", "Toga", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "Uruguay", "USA", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands", "Wales", "Wallis and Futuna", "West Bank", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

var s_a = new Array();
s_a[0] = "";
s_a[1] = "Badakhshan|Badghis|Baghlan|Balkh|Bamian|Farah|Faryab|Ghazni|Ghowr|Helmand|Herat|Jowzjan|Kabol|Kandahar|Kapisa|Konar|Kondoz|Laghman|Lowgar|Nangarhar|Nimruz|Oruzgan|Paktia|Paktika|Parvan|Samangan|Sar-e Pol|Takhar|Vardak|Zabol";
s_a[2] = "Berat|Bulqize|Delvine|Devoll (Bilisht)|Diber (Peshkopi)|Durres|Elbasan|Fier|Gjirokaster|Gramsh|Has (Krume)|Kavaje|Kolonje (Erseke)|Korce|Kruje|Kucove|Kukes|Kurbin|Lezhe|Librazhd|Lushnje|Malesi e Madhe (Koplik)|Mallakaster (Ballsh)|Mat (Burrel)|Mirdite (Rreshen)|Peqin|Permet|Pogradec|Puke|Sarande|Shkoder|Skrapar (Corovode)|Tepelene|Tirane (Tirana)|Tirane (Tirana)|Tropoje (Bajram Curri)|Vlore";
s_a[3] = "Adrar|Ain Defla|Ain Temouchent|Alger|Annaba|Batna|Bechar|Bejaia|Biskra|Blida|Bordj Bou Arreridj|Bouira|Boumerdes|Chlef|Constantine|Djelfa|El Bayadh|El Oued|El Tarf|Ghardaia|Guelma|Illizi|Jijel|Khenchela|Laghouat|M'Sila|Mascara|Medea|Mila|Mostaganem|Naama|Oran|Ouargla|Oum el Bouaghi|Relizane|Saida|Setif|Sidi Bel Abbes|Skikda|Souk Ahras|Tamanghasset|Tebessa|Tiaret|Tindouf|Tipaza|Tissemsilt|Tizi Ouzou|Tlemcen";
s_a[4] = "Eastern|Manu'a|Rose Island|Swains Island|Western";
s_a[5] = "Andorra la Vella|Bengo|Benguela|Bie|Cabinda|Canillo|Cuando Cubango|Cuanza Norte|Cuanza Sul|Cunene|Encamp|Escaldes-Engordany|Huambo|Huila|La Massana|Luanda|Lunda Norte|Lunda Sul|Malanje|Moxico|Namibe|Ordino|Sant Julia de Loria|Uige|Zaire";
s_a[6] = "Anguilla";
s_a[7] = "Antartica";
s_a[8] = "Barbuda|Redonda|Saint George|Saint John|Saint Mary|Saint Paul|Saint Peter|Saint Philip";
s_a[9] = "Antartica e Islas del Atlantico Sur|Buenos Aires|Buenos Aires Capital Federal|Catamarca|Chaco|Chubut|Cordoba|Corrientes|Entre Rios|Formosa|Jujuy|La Pampa|La Rioja|Mendoza|Misiones|Neuquen|Rio Negro|Salta|San Juan|San Luis|Santa Cruz|Santa Fe|Santiago del Estero|Tierra del Fuego|Tucuman";
s_a[10] = "Aragatsotn|Ararat|Armavir|Geghark'unik'|Kotayk'|Lorri|Shirak|Syunik'|Tavush|Vayots' Dzor|Yerevan";
s_a[11] = "Aruba";
s_a[12] = "Ashmore and Cartier Island";
s_a[13] = "Australian Capital Territory|New South Wales|Northern Territory|Queensland|South Australia|Tasmania|Victoria|Western Australia";
s_a[14] = "Burgenland|Kaernten|Niederoesterreich|Oberoesterreich|Salzburg|Steiermark|Tirol|Vorarlberg|Wien";
s_a[15] = "Abseron Rayonu|Agcabadi Rayonu|Agdam Rayonu|Agdas Rayonu|Agstafa Rayonu|Agsu Rayonu|Ali Bayramli Sahari|Astara Rayonu|Baki Sahari|Balakan Rayonu|Barda Rayonu|Beylaqan Rayonu|Bilasuvar Rayonu|Cabrayil Rayonu|Calilabad Rayonu|Daskasan Rayonu|Davaci Rayonu|Fuzuli Rayonu|Gadabay Rayonu|Ganca Sahari|Goranboy Rayonu|Goycay Rayonu|Haciqabul Rayonu|Imisli Rayonu|Ismayilli Rayonu|Kalbacar Rayonu|Kurdamir Rayonu|Lacin Rayonu|Lankaran Rayonu|Lankaran Sahari|Lerik Rayonu|Masalli Rayonu|Mingacevir Sahari|Naftalan Sahari|Naxcivan Muxtar Respublikasi|Neftcala Rayonu|Oguz Rayonu|Qabala Rayonu|Qax Rayonu|Qazax Rayonu|Qobustan Rayonu|Quba Rayonu|Qubadli Rayonu|Qusar Rayonu|Saatli Rayonu|Sabirabad Rayonu|Saki Rayonu|Saki Sahari|Salyan Rayonu|Samaxi Rayonu|Samkir Rayonu|Samux Rayonu|Siyazan Rayonu|Sumqayit Sahari|Susa Rayonu|Susa Sahari|Tartar Rayonu|Tovuz Rayonu|Ucar Rayonu|Xacmaz Rayonu|Xankandi Sahari|Xanlar Rayonu|Xizi Rayonu|Xocali Rayonu|Xocavand Rayonu|Yardimli Rayonu|Yevlax Rayonu|Yevlax Sahari|Zangilan Rayonu|Zaqatala Rayonu|Zardab Rayonu";
s_a[16] = "Acklins and Crooked Islands|Bimini|Cat Island|Exuma|Freeport|Fresh Creek|Governor's Harbour|Green Turtle Cay|Harbour Island|High Rock|Inagua|Kemps Bay|Long Island|Marsh Harbour|Mayaguana|New Providence|Nicholls Town and Berry Islands|Ragged Island|Rock Sound|San Salvador and Rum Cay|Sandy Point";
s_a[17] = "Al Hadd|Al Manamah|Al Mintaqah al Gharbiyah|Al Mintaqah al Wusta|Al Mintaqah ash Shamaliyah|Al Muharraq|Ar Rifa' wa al Mintaqah al Janubiyah|Jidd Hafs|Juzur Hawar|Madinat 'Isa|Madinat Hamad|Sitrah";
s_a[18] = "Barguna|Barisal|Bhola|Jhalokati|Patuakhali|Pirojpur|Bandarban|Brahmanbaria|Chandpur|Chittagong|Comilla|Cox's Bazar|Feni|Khagrachari|Lakshmipur|Noakhali|Rangamati|Dhaka|Faridpur|Gazipur|Gopalganj|Jamalpur|Kishoreganj|Madaripur|Manikganj|Munshiganj|Mymensingh|Narayanganj|Narsingdi|Netrokona|Rajbari|Shariatpur|Sherpur|Tangail|Bagerhat|Chuadanga|Jessore|Jhenaidah|Khulna|Kushtia|Magura|Meherpur|Narail|Satkhira|Bogra|Dinajpur|Gaibandha|Jaipurhat|Kurigram|Lalmonirhat|Naogaon|Natore|Nawabganj|Nilphamari|Pabna|Panchagarh|Rajshahi|Rangpur|Sirajganj|Thakurgaon|Habiganj|Maulvi bazar|Sunamganj|Sylhet";
s_a[19] = "Bridgetown|Christ Church|Saint Andrew|Saint George|Saint James|Saint John|Saint Joseph|Saint Lucy|Saint Michael|Saint Peter|Saint Philip|Saint Thomas";
s_a[20] = "Brestskaya (Brest)|Homyel'skaya (Homyel')|Horad Minsk|Hrodzyenskaya (Hrodna)|Mahilyowskaya (Mahilyow)|Minskaya|Vitsyebskaya (Vitsyebsk)";
s_a[21] = "Antwerpen|Brabant Wallon|Brussels Capitol Region|Hainaut|Liege|Limburg|Luxembourg|Namur|Oost-Vlaanderen|Vlaams Brabant|West-Vlaanderen";
s_a[22] = "Belize|Cayo|Corozal|Orange Walk|Stann Creek|Toledo";
s_a[23] = "Alibori|Atakora|Atlantique|Borgou|Collines|Couffo|Donga|Littoral|Mono|Oueme|Plateau|Zou";
s_a[24] = "Devonshire|Hamilton|Hamilton|Paget|Pembroke|Saint George|Saint Georges|Sandys|Smiths|Southampton|Warwick";
s_a[25] = "Bumthang|Chhukha|Chirang|Daga|Geylegphug|Ha|Lhuntshi|Mongar|Paro|Pemagatsel|Punakha|Samchi|Samdrup Jongkhar|Shemgang|Tashigang|Thimphu|Tongsa|Wangdi Phodrang";
s_a[26] = "Beni|Chuquisaca|Cochabamba|La Paz|Oruro|Pando|Potosi|Santa Cruz|Tarija";
s_a[27] = "Federation of Bosnia and Herzegovina|Republika Srpska";
s_a[28] = "Central|Chobe|Francistown|Gaborone|Ghanzi|Kgalagadi|Kgatleng|Kweneng|Lobatse|Ngamiland|North-East|Selebi-Pikwe|South-East|Southern";
s_a[29] = "Acre|Alagoas|Amapa|Amazonas|Bahia|Ceara|Distrito Federal|Espirito Santo|Goias|Maranhao|Mato Grosso|Mato Grosso do Sul|Minas Gerais|Para|Paraiba|Parana|Pernambuco|Piaui|Rio de Janeiro|Rio Grande do Norte|Rio Grande do Sul|Rondonia|Roraima|Santa Catarina|Sao Paulo|Sergipe|Tocantins";
s_a[30] = "Anegada|Jost Van Dyke|Tortola|Virgin Gorda";
s_a[31] = "Belait|Brunei and Muara|Temburong|Tutong";
s_a[32] = "Blagoevgrad|Burgas|Dobrich|Gabrovo|Khaskovo|Kurdzhali|Kyustendil|Lovech|Montana|Pazardzhik|Pernik|Pleven|Plovdiv|Razgrad|Ruse|Shumen|Silistra|Sliven|Smolyan|Sofiya|Sofiya-Grad|Stara Zagora|Turgovishte|Varna|Veliko Turnovo|Vidin|Vratsa|Yambol";
s_a[33] = "Bale|Bam|Banwa|Bazega|Bougouriba|Boulgou|Boulkiemde|Comoe|Ganzourgou|Gnagna|Gourma|Houet|Ioba|Kadiogo|Kenedougou|Komandjari|Kompienga|Kossi|Koupelogo|Kouritenga|Kourweogo|Leraba|Loroum|Mouhoun|Nahouri|Namentenga|Naumbiel|Nayala|Oubritenga|Oudalan|Passore|Poni|Samentenga|Sanguie|Seno|Sissili|Soum|Sourou|Tapoa|Tuy|Yagha|Yatenga|Ziro|Zondomo|Zoundweogo";
s_a[34] = "Ayeyarwady|Bago|Chin State|Kachin State|Kayah State|Kayin State|Magway|Mandalay|Mon State|Rakhine State|Sagaing|Shan State|Tanintharyi|Yangon";
s_a[35] = "Bubanza|Bujumbura|Bururi|Cankuzo|Cibitoke|Gitega|Karuzi|Kayanza|Kirundo|Makamba|Muramvya|Muyinga|Mwaro|Ngozi|Rutana|Ruyigi";
s_a[36] = "Banteay Mean Cheay|Batdambang|Kampong Cham|Kampong Chhnang|Kampong Spoe|Kampong Thum|Kampot|Kandal|Kaoh Kong|Keb|Kracheh|Mondol Kiri|Otdar Mean Cheay|Pailin|Phnum Penh|Pouthisat|Preah Seihanu (Sihanoukville)|Preah Vihear|Prey Veng|Rotanah Kiri|Siem Reab|Stoeng Treng|Svay Rieng|Takev";
s_a[37] = "Adamaoua|Centre|Est|Extreme-Nord|Littoral|Nord|Nord-Ouest|Ouest|Sud|Sud-Ouest";
s_a[38] = "Alberta|British Columbia|Manitoba|New Brunswick|Newfoundland|Northwest Territories|Nova Scotia|Nunavut|Ontario|Prince Edward Island|Quebec|Saskatchewan|Yukon Territory";
s_a[39] = "Boa Vista|Brava|Maio|Mosteiros|Paul|Porto Novo|Praia|Ribeira Grande|Sal|Santa Catarina|Santa Cruz|Sao Domingos|Sao Filipe|Sao Nicolau|Sao Vicente|Tarrafal";
s_a[40] = "Creek|Eastern|Midland|South Town|Spot Bay|Stake Bay|West End|Western";
s_a[41] = "Bamingui-Bangoran|Bangui|Basse-Kotto|Gribingui|Haut-Mbomou|Haute-Kotto|Haute-Sangha|Kemo-Gribingui|Lobaye|Mbomou|Nana-Mambere|Ombella-Mpoko|Ouaka|Ouham|Ouham-Pende|Sangha|Vakaga";
s_a[42] = "Batha|Biltine|Borkou-Ennedi-Tibesti|Chari-Baguirmi|Guera|Kanem|Lac|Logone Occidental|Logone Oriental|Mayo-Kebbi|Moyen-Chari|Ouaddai|Salamat|Tandjile";
s_a[43] = "Aisen del General Carlos Ibanez del Campo|Antofagasta|Araucania|Atacama|Bio-Bio|Coquimbo|Libertador General Bernardo O'Higgins|Los Lagos|Magallanes y de la Antartica Chilena|Maule|Region Metropolitana (Santiago)|Tarapaca|Valparaiso";
s_a[44] = "Anhui|Beijing|Chongqing|Fujian|Gansu|Guangdong|Guangxi|Guizhou|Hainan|Hebei|Heilongjiang|Henan|Hubei|Hunan|Jiangsu|Jiangxi|Jilin|Liaoning|Nei Mongol|Ningxia|Qinghai|Shaanxi|Shandong|Shanghai|Shanxi|Sichuan|Tianjin|Xinjiang|Xizang (Tibet)|Yunnan|Zhejiang";
s_a[45] = "Christmas Island";
s_a[46] = "Clipperton Island";
s_a[47] = "Direction Island|Home Island|Horsburgh Island|North Keeling Island|South Island|West Island";
s_a[48] = "Amazonas|Antioquia|Arauca|Atlantico|Bolivar|Boyaca|Caldas|Caqueta|Casanare|Cauca|Cesar|Choco|Cordoba|Cundinamarca|Distrito Capital de Santa Fe de Bogota|Guainia|Guaviare|Huila|La Guajira|Magdalena|Meta|Narino|Norte de Santander|Putumayo|Quindio|Risaralda|San Andres y Providencia|Santander|Sucre|Tolima|Valle del Cauca|Vaupes|Vichada";
// &lt;!-- -->
s_a[49] = "Anjouan (Nzwani)|Domoni|Fomboni|Grande Comore (Njazidja)|Moheli (Mwali)|Moroni|Moutsamoudou";
s_a[50] = "Bandundu|Bas-Congo|Equateur|Kasai-Occidental|Kasai-Oriental|Katanga|Kinshasa|Maniema|Nord-Kivu|Orientale|Sud-Kivu";
s_a[51] = "Bouenza|Brazzaville|Cuvette|Kouilou|Lekoumou|Likouala|Niari|Plateaux|Pool|Sangha";
s_a[52] = "Aitutaki|Atiu|Avarua|Mangaia|Manihiki|Manuae|Mauke|Mitiaro|Nassau Island|Palmerston|Penrhyn|Pukapuka|Rakahanga|Rarotonga|Suwarrow|Takutea";
s_a[53] = "Alajuela|Cartago|Guanacaste|Heredia|Limon|Puntarenas|San Jose";
s_a[54] = "Abengourou|Abidjan|Aboisso|Adiake'|Adzope|Agboville|Agnibilekrou|Ale'pe'|Bangolo|Beoumi|Biankouma|Bocanda|Bondoukou|Bongouanou|Bouafle|Bouake|Bouna|Boundiali|Dabakala|Dabon|Daloa|Danane|Daoukro|Dimbokro|Divo|Duekoue|Ferkessedougou|Gagnoa|Grand Bassam|Grand-Lahou|Guiglo|Issia|Jacqueville|Katiola|Korhogo|Lakota|Man|Mankono|Mbahiakro|Odienne|Oume|Sakassou|San-Pedro|Sassandra|Seguela|Sinfra|Soubre|Tabou|Tanda|Tiassale|Tiebissou|Tingrela|Touba|Toulepleu|Toumodi|Vavoua|Yamoussoukro|Zuenoula";
s_a[55] = "Bjelovarsko-Bilogorska Zupanija|Brodsko-Posavska Zupanija|Dubrovacko-Neretvanska Zupanija|Istarska Zupanija|Karlovacka Zupanija|Koprivnicko-Krizevacka Zupanija|Krapinsko-Zagorska Zupanija|Licko-Senjska Zupanija|Medimurska Zupanija|Osjecko-Baranjska Zupanija|Pozesko-Slavonska Zupanija|Primorsko-Goranska Zupanija|Sibensko-Kninska Zupanija|Sisacko-Moslavacka Zupanija|Splitsko-Dalmatinska Zupanija|Varazdinska Zupanija|Viroviticko-Podravska Zupanija|Vukovarsko-Srijemska Zupanija|Zadarska Zupanija|Zagreb|Zagrebacka Zupanija";
s_a[56] = "Camaguey|Ciego de Avila|Cienfuegos|Ciudad de La Habana|Granma|Guantanamo|Holguin|Isla de la Juventud|La Habana|Las Tunas|Matanzas|Pinar del Rio|Sancti Spiritus|Santiago de Cuba|Villa Clara";
s_a[57] = "Famagusta|Kyrenia|Larnaca|Limassol|Nicosia|Paphos";
s_a[58] = "Brnensky|Budejovicky|Jihlavsky|Karlovarsky|Kralovehradecky|Liberecky|Olomoucky|Ostravsky|Pardubicky|Plzensky|Praha|Stredocesky|Ustecky|Zlinsky";
s_a[59] = "Arhus|Bornholm|Fredericksberg|Frederiksborg|Fyn|Kobenhavn|Kobenhavns|Nordjylland|Ribe|Ringkobing|Roskilde|Sonderjylland|Storstrom|Vejle|Vestsjalland|Viborg";
s_a[60] = "'Ali Sabih|Dikhil|Djibouti|Obock|Tadjoura";
s_a[61] = "Saint Andrew|Saint David|Saint George|Saint John|Saint Joseph|Saint Luke|Saint Mark|Saint Patrick|Saint Paul|Saint Peter";
s_a[62] = "Azua|Baoruco|Barahona|Dajabon|Distrito Nacional|Duarte|El Seibo|Elias Pina|Espaillat|Hato Mayor|Independencia|La Altagracia|La Romana|La Vega|Maria Trinidad Sanchez|Monsenor Nouel|Monte Cristi|Monte Plata|Pedernales|Peravia|Puerto Plata|Salcedo|Samana|San Cristobal|San Juan|San Pedro de Macoris|Sanchez Ramirez|Santiago|Santiago Rodriguez|Valverde";
// &lt;!-- -->
s_a[63] = "Azuay|Bolivar|Canar|Carchi|Chimborazo|Cotopaxi|El Oro|Esmeraldas|Galapagos|Guayas|Imbabura|Loja|Los Rios|Manabi|Morona-Santiago|Napo|Orellana|Pastaza|Pichincha|Sucumbios|Tungurahua|Zamora-Chinchipe";
s_a[64] = "Ad Daqahliyah|Al Bahr al Ahmar|Al Buhayrah|Al Fayyum|Al Gharbiyah|Al Iskandariyah|Al Isma'iliyah|Al Jizah|Al Minufiyah|Al Minya|Al Qahirah|Al Qalyubiyah|Al Wadi al Jadid|As Suways|Ash Sharqiyah|Aswan|Asyut|Bani Suwayf|Bur Sa'id|Dumyat|Janub Sina'|Kafr ash Shaykh|Matruh|Qina|Shamal Sina'|Suhaj";
s_a[65] = "Ahuachapan|Cabanas|Chalatenango|Cuscatlan|La Libertad|La Paz|La Union|Morazan|San Miguel|San Salvador|San Vicente|Santa Ana|Sonsonate|Usulutan";
s_a[66] = "Annobon|Bioko Norte|Bioko Sur|Centro Sur|Kie-Ntem|Litoral|Wele-Nzas";
s_a[67] = "Akale Guzay|Barka|Denkel|Hamasen|Sahil|Semhar|Senhit|Seraye";
s_a[68] = "Harjumaa (Tallinn)|Hiiumaa (Kardla)|Ida-Virumaa (Johvi)|Jarvamaa (Paide)|Jogevamaa (Jogeva)|Laane-Virumaa (Rakvere)|Laanemaa (Haapsalu)|Parnumaa (Parnu)|Polvamaa (Polva)|Raplamaa (Rapla)|Saaremaa (Kuessaare)|Tartumaa (Tartu)|Valgamaa (Valga)|Viljandimaa (Viljandi)|Vorumaa (Voru)"
s_a[69] = "Adis Abeba (Addis Ababa)|Afar|Amara|Dire Dawa|Gambela Hizboch|Hareri Hizb|Oromiya|Sumale|Tigray|YeDebub Biheroch Bihereseboch na Hizboch";
s_a[70] = "Europa Island";
s_a[71] = "Falkland Islands (Islas Malvinas)"
s_a[72] = "Bordoy|Eysturoy|Mykines|Sandoy|Skuvoy|Streymoy|Suduroy|Tvoroyri|Vagar";
s_a[73] = "Central|Eastern|Northern|Rotuma|Western";
s_a[74] = "Aland|Etela-Suomen Laani|Ita-Suomen Laani|Lansi-Suomen Laani|Lappi|Oulun Laani";
s_a[75] = "Alsace|Aquitaine|Auvergne|Basse-Normandie|Bourgogne|Bretagne|Centre|Champagne-Ardenne|Corse|Franche-Comte|Haute-Normandie|Ile-de-France|Languedoc-Roussillon|Limousin|Lorraine|Midi-Pyrenees|Nord-Pas-de-Calais|Pays de la Loire|Picardie|Poitou-Charentes|Provence-Alpes-Cote d'Azur|Rhone-Alpes";
s_a[76] = "French Guiana";
s_a[77] = "Archipel des Marquises|Archipel des Tuamotu|Archipel des Tubuai|Iles du Vent|Iles Sous-le-Vent";
s_a[78] = "Adelie Land|Ile Crozet|Iles Kerguelen|Iles Saint-Paul et Amsterdam";
s_a[79] = "Estuaire|Haut-Ogooue|Moyen-Ogooue|Ngounie|Nyanga|Ogooue-Ivindo|Ogooue-Lolo|Ogooue-Maritime|Woleu-Ntem";
s_a[80] = "Banjul|Central River|Lower River|North Bank|Upper River|Western";
s_a[81] = "Gaza Strip";
s_a[82] = "Abashis|Abkhazia or Ap'khazet'is Avtonomiuri Respublika (Sokhumi)|Adigenis|Ajaria or Acharis Avtonomiuri Respublika (Bat'umi)|Akhalgoris|Akhalk'alak'is|Akhalts'ikhis|Akhmetis|Ambrolauris|Aspindzis|Baghdat'is|Bolnisis|Borjomis|Ch'khorotsqus|Ch'okhatauris|Chiat'ura|Dedop'listsqaros|Dmanisis|Dushet'is|Gardabanis|Gori|Goris|Gurjaanis|Javis|K'arelis|K'ut'aisi|Kaspis|Kharagaulis|Khashuris|Khobis|Khonis|Lagodekhis|Lanch'khut'is|Lentekhis|Marneulis|Martvilis|Mestiis|Mts'khet'is|Ninotsmindis|Onis|Ozurget'is|P'ot'i|Qazbegis|Qvarlis|Rust'avi|Sach'kheris|Sagarejos|Samtrediis|Senakis|Sighnaghis|T'bilisi|T'elavis|T'erjolis|T'et'ritsqaros|T'ianet'is|Tqibuli|Ts'ageris|Tsalenjikhis|Tsalkis|Tsqaltubo|Vanis|Zestap'onis|Zugdidi|Zugdidis";
s_a[83] = "Baden-Wuerttemberg|Bayern|Berlin|Brandenburg|Bremen|Hamburg|Hessen|Mecklenburg-Vorpommern|Niedersachsen|Nordrhein-Westfalen|Rheinland-Pfalz|Saarland|Sachsen|Sachsen-Anhalt|Schleswig-Holstein|Thueringen";
s_a[84] = "Ashanti|Brong-Ahafo|Central|Eastern|Greater Accra|Northern|Upper East|Upper West|Volta|Western";
s_a[85] = "Gibraltar";
s_a[86] = "Ile du Lys|Ile Glorieuse";
s_a[87] = "Aitolia kai Akarnania|Akhaia|Argolis|Arkadhia|Arta|Attiki|Ayion Oros (Mt. Athos)|Dhodhekanisos|Drama|Evritania|Evros|Evvoia|Florina|Fokis|Fthiotis|Grevena|Ilia|Imathia|Ioannina|Irakleion|Kardhitsa|Kastoria|Kavala|Kefallinia|Kerkyra|Khalkidhiki|Khania|Khios|Kikladhes|Kilkis|Korinthia|Kozani|Lakonia|Larisa|Lasithi|Lesvos|Levkas|Magnisia|Messinia|Pella|Pieria|Preveza|Rethimni|Rodhopi|Samos|Serrai|Thesprotia|Thessaloniki|Trikala|Voiotia|Xanthi|Zakinthos";
s_a[88] = "Avannaa (Nordgronland)|Kitaa (Vestgronland)|Tunu (Ostgronland)"
s_a[89] = "Carriacou and Petit Martinique|Saint Andrew|Saint David|Saint George|Saint John|Saint Mark|Saint Patrick";
s_a[90] = "Basse-Terre|Grande-Terre|Iles de la Petite Terre|Iles des Saintes|Marie-Galante";
s_a[91] = "Guam";
s_a[92] = "Alta Verapaz|Baja Verapaz|Chimaltenango|Chiquimula|El Progreso|Escuintla|Guatemala|Huehuetenango|Izabal|Jalapa|Jutiapa|Peten|Quetzaltenango|Quiche|Retalhuleu|Sacatepequez|San Marcos|Santa Rosa|Solola|Suchitepequez|Totonicapan|Zacapa";
s_a[93] = "Castel|Forest|St. Andrew|St. Martin|St. Peter Port|St. Pierre du Bois|St. Sampson|St. Saviour|Torteval|Vale";
s_a[94] = "Beyla|Boffa|Boke|Conakry|Coyah|Dabola|Dalaba|Dinguiraye|Dubreka|Faranah|Forecariah|Fria|Gaoual|Gueckedou|Kankan|Kerouane|Kindia|Kissidougou|Koubia|Koundara|Kouroussa|Labe|Lelouma|Lola|Macenta|Mali|Mamou|Mandiana|Nzerekore|Pita|Siguiri|Telimele|Tougue|Yomou";
s_a[95] = "Bafata|Biombo|Bissau|Bolama-Bijagos|Cacheu|Gabu|Oio|Quinara|Tombali";
s_a[96] = "Barima-Waini|Cuyuni-Mazaruni|Demerara-Mahaica|East Berbice-Corentyne|Essequibo Islands-West Demerara|Mahaica-Berbice|Pomeroon-Supenaam|Potaro-Siparuni|Upper Demerara-Berbice|Upper Takutu-Upper Essequibo";
s_a[97] = "Artibonite|Centre|Grand'Anse|Nord|Nord-Est|Nord-Ouest|Ouest|Sud|Sud-Est";
s_a[98] = "Heard Island and McDonald Islands";
s_a[99] = "Holy See (Vatican City)"
s_a[100] = "Atlantida|Choluteca|Colon|Comayagua|Copan|Cortes|El Paraiso|Francisco Morazan|Gracias a Dios|Intibuca|Islas de la Bahia|La Paz|Lempira|Ocotepeque|Olancho|Santa Barbara|Valle|Yoro";
s_a[101] = "Hong Kong";
s_a[102] = "Howland Island";
s_a[103] = "Bacs-Kiskun|Baranya|Bekes|Bekescsaba|Borsod-Abauj-Zemplen|Budapest|Csongrad|Debrecen|Dunaujvaros|Eger|Fejer|Gyor|Gyor-Moson-Sopron|Hajdu-Bihar|Heves|Hodmezovasarhely|Jasz-Nagykun-Szolnok|Kaposvar|Kecskemet|Komarom-Esztergom|Miskolc|Nagykanizsa|Nograd|Nyiregyhaza|Pecs|Pest|Somogy|Sopron|Szabolcs-Szatmar-Bereg|Szeged|Szekesfehervar|Szolnok|Szombathely|Tatabanya|Tolna|Vas|Veszprem|Veszprem|Zala|Zalaegerszeg";
s_a[104] = "Akranes|Akureyri|Arnessysla|Austur-Bardhastrandarsysla|Austur-Hunavatnssysla|Austur-Skaftafellssysla|Borgarfjardharsysla|Dalasysla|Eyjafjardharsysla|Gullbringusysla|Hafnarfjordhur|Husavik|Isafjordhur|Keflavik|Kjosarsysla|Kopavogur|Myrasysla|Neskaupstadhur|Nordhur-Isafjardharsysla|Nordhur-Mulasys-la|Nordhur-Thingeyjarsysla|Olafsfjordhur|Rangarvallasysla|Reykjavik|Saudharkrokur|Seydhisfjordhur|Siglufjordhur|Skagafjardharsysla|Snaefellsnes-og Hnappadalssysla|Strandasysla|Sudhur-Mulasysla|Sudhur-Thingeyjarsysla|Vesttmannaeyjar|Vestur-Bardhastrandarsysla|Vestur-Hunavatnssysla|Vestur-Isafjardharsysla|Vestur-Skaftafellssysla";
s_a[105] = "Andaman and Nicobar Islands|Andhra Pradesh|Arunachal Pradesh|Assam|Bihar|Chandigarh|Chhattisgarh|Dadra and Nagar Haveli|Daman and Diu|Delhi|Goa|Gujarat|Haryana|Himachal Pradesh|Jammu and Kashmir|Jharkhand|Karnataka|Kerala|Lakshadweep|Madhya Pradesh|Maharashtra|Manipur|Meghalaya|Mizoram|Nagaland|Orissa|Pondicherry|Punjab|Rajasthan|Sikkim|Tamil Nadu|Tripura|Uttar Pradesh|Uttaranchal|West Bengal";


var selectedcountry='';
selectedcountry='<?php if(!empty($profile_data)) { echo $profile_data->country; }  ?>';

function print_country(country_id) {
    // given the id of the &lt;select> tag as function argument, it inserts &lt;option> tags
    var option_str = document.getElementById(country_id);
    option_str.length = 0;
    if(selectedcountry!=''){
        option_str.options[0] = new Option(selectedcountry,'');
    }
    else{
        option_str.options[0] = new Option('Select Country', '');
    }

    option_str.selectedIndex = 0;
    for (var i = 0; i < country_arr.length; i++) {
        option_str.options[option_str.length] = new Option(country_arr[i], country_arr[i]);
    }
}

function print_state(state_id, state_index) {
    var option_str = document.getElementById(state_id);
    option_str.length = 0; // Fixed by Julian Woods
    option_str.options[0] = new Option('Select State', '');
    option_str.selectedIndex = 0;
    var state_arr = s_a[state_index].split("|");
    for (var i = 0; i < state_arr.length; i++) {
        option_str.options[option_str.length] = new Option(state_arr[i], state_arr[i]);
    }
}

</script>
<?php
$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
?>
<div class="modal fade" id="edite" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="table-heading">Edit Profile</h4>
      </div>
      <form method="POST" action="{{ url('/profileupdate')}}/{{ $user_data->user_id }}">
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
              <label class="form-label-color title-label-w">Job Title</label>
              <input class="lang_input" type="text" name="job_title" value="@if(!empty($profile_data)){{ $profile_data->job_title }}@endif">
            </div>
        </div>
        <div class="modal-body">
            <div class="form-group">
          <label class="form-label-color title-label-w">Country</label>
          <select class="lang_input" onchange="print_state('states',this.selectedIndex);" name="country" id="country">
          </select>
       <script type="text/javascript" language="javascript">
           print_country("country");
       </script>
       </div>
       </div>
       <div class="modal-body">
           <div class="form-group">
          <label class="form-label-color title-label-w">State</label>
       <select  name="state" id="states" class="lang_input">
       <option value="@if(!empty($profile_data)){{ $profile_data->state }}@endif">@if(!empty($profile_data)){{ $profile_data->state }}@endif</option>
       </select>
      </div>
       </div>
          <?php
          $timezones = array(
              'America/Adak' => '(GMT-10:00) Adak (Hawaii-Aleutian Standard Time)',
              'America/Atka' => '(GMT-10:00) Atka (Hawaii-Aleutian Standard Time)',
              'America/Anchorage' => '(GMT-9:00) Anchorage (Alaska Standard Time)',
              'America/Juneau' => '(GMT-9:00) Juneau (Alaska Standard Time)',
              'America/Nome' => '(GMT-9:00) Nome (Alaska Standard Time)',
              'America/Yakutat' => '(GMT-9:00) Yakutat (Alaska Standard Time)',
              'America/Dawson' => '(GMT-8:00) Dawson (Pacific Standard Time)',
              'America/Ensenada' => '(GMT-8:00) Ensenada (Pacific Standard Time)',
              'America/Los_Angeles' => '(GMT-8:00) Los_Angeles (Pacific Standard Time)',
              'America/Tijuana' => '(GMT-8:00) Tijuana (Pacific Standard Time)',
              'America/Vancouver' => '(GMT-8:00) Vancouver (Pacific Standard Time)',
              'America/Whitehorse' => '(GMT-8:00) Whitehorse (Pacific Standard Time)',
              'Canada/Pacific' => '(GMT-8:00) Pacific (Pacific Standard Time)',
              'Canada/Yukon' => '(GMT-8:00) Yukon (Pacific Standard Time)',
              'Mexico/BajaNorte' => '(GMT-8:00)BajaNorte (Pacific Standard Time)',
              'America/Boise' => '(GMT-7:00) Boise (Mountain Standard Time)',
              'America/Cambridge_Bay' => '(GMT-7:00) Cambridge_Bay (Mountain Standard Time)',
              'America/Chihuahua' => '(GMT-7:00) Chihuahua (Mountain Standard Time)',
              'America/Dawson_Creek' => '(GMT-7:00) Dawson_Creek (Mountain Standard Time)',
              'America/Denver' => '(GMT-7:00) Denver (Mountain Standard Time)',
              'America/Edmonton' => '(GMT-7:00) Edmonton (Mountain Standard Time)',
              'America/Hermosillo' => '(GMT-7:00) Hermosillo (Mountain Standard Time)',
              'America/Inuvik' => '(GMT-7:00) Inuvik (Mountain Standard Time)',
              'America/Mazatlan' => '(GMT-7:00) Mazatlan (Mountain Standard Time)',
              'America/Phoenix' => '(GMT-7:00) Phoenix (Mountain Standard Time)',
              'America/Shiprock' => '(GMT-7:00) Shiprock (Mountain Standard Time)',
              'America/Yellowknife' => '(GMT-7:00) Yellowknife (Mountain Standard Time)',
              'Canada/Mountain' => '(GMT-7:00)Mountain (Mountain Standard Time)',
              'Mexico/BajaSur' => '(GMT-7:00) BajaSur (Mountain Standard Time)',
              'America/Belize' => '(GMT-6:00) Belize (Central Standard Time)',
              'America/Cancun' => '(GMT-6:00) Cancun (Central Standard Time)',
              'America/Chicago' => '(GMT-6:00) Chicago (Central Standard Time)',
              'America/Costa_Rica' => '(GMT-6:00) Costa_Rica (Central Standard Time)',
              'America/El_Salvador' => '(GMT-6:00) El_Salvador (Central Standard Time)',
              'America/Guatemala' => '(GMT-6:00) Guatemala (Central Standard Time)',
              'America/Knox_IN' => '(GMT-6:00) Knox_IN (Central Standard Time)',
              'America/Managua' => '(GMT-6:00) Managua (Central Standard Time)',
              'America/Menominee' => '(GMT-6:00) Menominee (Central Standard Time)',
              'America/Merida' => '(GMT-6:00) Merida (Central Standard Time)',
              'America/Mexico_City' => '(GMT-6:00) Mexico_City (Central Standard Time)',
              'America/Monterrey' => '(GMT-6:00) Monterrey (Central Standard Time)',
              'America/Rainy_River' => '(GMT-6:00) Rainy_River (Central Standard Time)',
              'America/Rankin_Inlet' => '(GMT-6:00) Rankin_Inlet (Central Standard Time)',
              'America/Regina' => '(GMT-6:00) Regina (Central Standard Time)',
              'America/Swift_Current' => '(GMT-6:00) Swift_Current (Central Standard Time)',
              'America/Tegucigalpa' => '(GMT-6:00) Tegucigalpa (Central Standard Time)',
              'America/Winnipeg' => '(GMT-6:00) Winnipeg (Central Standard Time)',
              'Canada/Central' => '(GMT-6:00) Central (Central Standard Time)',
              'Canada/East-Saskatchewan' => '(GMT-6:00) East-Saskatchewan (Central Standard Time)',
              'Canada/Saskatchewan' => '(GMT-6:00) Saskatchewan (Central Standard Time)',
              'Chile/EasterIsland' => '(GMT-6:00) EasterIsland (Easter Is. Time)',
              'Mexico/General' => '(GMT-6:00) General (Central Standard Time)',
              'America/Atikokan' => '(GMT-5:00) Atikokan (Eastern Standard Time)',
              'America/Bogota' => '(GMT-5:00) Bogota (Colombia Time)',
              'America/Cayman' => '(GMT-5:00) Cayman (Eastern Standard Time)',
              'America/Coral_Harbour' => '(GMT-5:00) Coral_Harbour (Eastern Standard Time)',
              'America/Detroit' => '(GMT-5:00) Detroit (Eastern Standard Time)',
              'America/Fort_Wayne' => '(GMT-5:00) Fort_Wayne (Eastern Standard Time)',
              'America/Grand_Turk' => '(GMT-5:00) Grand_Turk (Eastern Standard Time)',
              'America/Guayaquil' => '(GMT-5:00) Guayaquil (Ecuador Time)',
              'America/Havana' => '(GMT-5:00) Havana (Cuba Standard Time)',
              'America/Indianapolis' => '(GMT-5:00) Indianapolis (Eastern Standard Time)',
              'America/Iqaluit' => '(GMT-5:00) Iqaluit (Eastern Standard Time)',
              'America/Jamaica' => '(GMT-5:00) Jamaica (Eastern Standard Time)',
              'America/Lima' => '(GMT-5:00) Lima (Peru Time)',
              'America/Louisville' => '(GMT-5:00) Louisville (Eastern Standard Time)',
              'America/Montreal' => '(GMT-5:00) Montreal (Eastern Standard Time)',
              'America/Nassau' => '(GMT-5:00) Nassau (Eastern Standard Time)',
              'America/New_York' => '(GMT-5:00) New_York (Eastern Standard Time)',
              'America/Nipigon' => '(GMT-5:00) Nipigon (Eastern Standard Time)',
              'America/Panama' => '(GMT-5:00) Panama (Eastern Standard Time)',
              'America/Pangnirtung' => '(GMT-5:00) Pangnirtung (Eastern Standard Time)',
              'America/Port-au-Prince' => '(GMT-5:00) Port-au-Prince (Eastern Standard Time)',
              'America/Resolute' => '(GMT-5:00) Resolute (Eastern Standard Time)',
              'America/Thunder_Bay' => '(GMT-5:00) Thunder_Bay (Eastern Standard Time)',
              'America/Toronto' => '(GMT-5:00) Toronto (Eastern Standard Time)',
              'Canada/Eastern' => '(GMT-5:00) Eastern (Eastern Standard Time)',
              'America/Caracas' => '(GMT-4:-30) Caracas (Venezuela Time)',
              'America/Anguilla' => '(GMT-4:00) Anguilla (Atlantic Standard Time)',
              'America/Antigua' => '(GMT-4:00) Antigua (Atlantic Standard Time)',
              'America/Aruba' => '(GMT-4:00) Aruba (Atlantic Standard Time)',
              'America/Asuncion' => '(GMT-4:00) Asuncion (Paraguay Time)',
              'America/Barbados' => '(GMT-4:00) Barbados (Atlantic Standard Time)',
              'America/Blanc-Sablon' => '(GMT-4:00) Blanc-Sablon (Atlantic Standard Time)',
              'America/Boa_Vista' => '(GMT-4:00) Boa_Vista (Amazon Time)',
              'America/Campo_Grande' => '(GMT-4:00) Campo_Grande (Amazon Time)',
              'America/Cuiaba' => '(GMT-4:00) Cuiaba (Amazon Time)',
              'America/Curacao' => '(GMT-4:00) Curacao (Atlantic Standard Time)',
              'America/Dominica' => '(GMT-4:00) Dominica (Atlantic Standard Time)',
              'America/Eirunepe' => '(GMT-4:00) Eirunepe (Amazon Time)',
              'America/Glace_Bay' => '(GMT-4:00) Glace_Bay (Atlantic Standard Time)',
              'America/Goose_Bay' => '(GMT-4:00) Goose_Bay (Atlantic Standard Time)',
              'America/Grenada' => '(GMT-4:00) Grenada (Atlantic Standard Time)',
              'America/Guadeloupe' => '(GMT-4:00) Guadeloupe (Atlantic Standard Time)',
              'America/Guyana' => '(GMT-4:00) Guyana (Guyana Time)',
              'America/Halifax' => '(GMT-4:00) Halifax (Atlantic Standard Time)',
              'America/La_Paz' => '(GMT-4:00) La_Paz (Bolivia Time)',
              'America/Manaus' => '(GMT-4:00) Manaus (Amazon Time)',
              'America/Marigot' => '(GMT-4:00) Marigot (Atlantic Standard Time)',
              'America/Martinique' => '(GMT-4:00) Martinique (Atlantic Standard Time)',
              'America/Moncton' => '(GMT-4:00) Moncton (Atlantic Standard Time)',
              'America/Montserrat' => '(GMT-4:00) Montserrat (Atlantic Standard Time)',
              'America/Port_of_Spain' => '(GMT-4:00) Port_of_Spain (Atlantic Standard Time)',
              'America/Porto_Acre' => '(GMT-4:00) Porto_Acre (Amazon Time)',
              'America/Porto_Velho' => '(GMT-4:00) Porto_Velho (Amazon Time)',
              'America/Puerto_Rico' => '(GMT-4:00) Puerto_Rico (Atlantic Standard Time)',
              'America/Rio_Branco' => '(GMT-4:00) Rio_Branco (Amazon Time)',
              'America/Santiago' => '(GMT-4:00) Santiago (Chile Time)',
              'America/Santo_Domingo' => '(GMT-4:00) Santo_Domingo (Atlantic Standard Time)',
              'America/St_Barthelemy' => '(GMT-4:00) St_Barthelemy (Atlantic Standard Time)',
              'America/St_Kitts' => '(GMT-4:00) St_Kitts (Atlantic Standard Time)',
              'America/St_Lucia' => '(GMT-4:00) St_Lucia (Atlantic Standard Time)',
              'America/St_Thomas' => '(GMT-4:00) St_Thomas (Atlantic Standard Time)',
              'America/St_Vincent' => '(GMT-4:00) St_Vincent (Atlantic Standard Time)',
              'America/Thule' => '(GMT-4:00) Thule (Atlantic Standard Time)',
              'America/Tortola' => '(GMT-4:00) Tortola (Atlantic Standard Time)',
              'America/Virgin' => '(GMT-4:00) Virgin (Atlantic Standard Time)',
              'Antarctica/Palmer' => '(GMT-4:00) Palmer (Chile Time)',
              'Atlantic/Bermuda' => '(GMT-4:00) Bermuda (Atlantic Standard Time)',
              'Atlantic/Stanley' => '(GMT-4:00) Stanley (Falkland Is. Time)',
              'Brazil/Acre' => '(GMT-4:00) Acre (Amazon Time)',
              'Brazil/West' => '(GMT-4:00) West (Amazon Time)',
              'Canada/Atlantic' => '(GMT-4:00) Atlantic (Atlantic Standard Time)',
              'Chile/Continental' => '(GMT-4:00) Continental (Chile Time)',
              'America/St_Johns' => '(GMT-3:-30)St_Johns (Newfoundland Standard Time)',
              'Canada/Newfoundland' => '(GMT-3:-30)Newfoundland (Newfoundland Standard Time)',
              'America/Araguaina' => '(GMT-3:00) Araguaina (Brasilia Time)',
              'America/Bahia' => '(GMT-3:00) Bahia (Brasilia Time)',
              'America/Belem' => '(GMT-3:00) Belem (Brasilia Time)',
              'America/Buenos_Aires' => '(GMT-3:00) Buenos_Aires (Argentine Time)',
              'America/Catamarca' => '(GMT-3:00) Catamarca (Argentine Time)',
              'America/Cayenne' => '(GMT-3:00) Cayenne (French Guiana Time)',
              'America/Cordoba' => '(GMT-3:00) Cordoba (Argentine Time)',
              'America/Fortaleza' => '(GMT-3:00) Fortaleza (Brasilia Time)',
              'America/Godthab' => '(GMT-3:00) Godthab (Western Greenland Time)',
              'America/Jujuy' => '(GMT-3:00) Jujuy (Argentine Time)',
              'America/Maceio' => '(GMT-3:00) Maceio (Brasilia Time)',
              'America/Mendoza' => '(GMT-3:00) Mendoza (Argentine Time)',
              'America/Miquelon' => '(GMT-3:00) Miquelon (Pierre & Miquelon Standard Time)',
              'America/Montevideo' => '(GMT-3:00) Montevideo (Uruguay Time)',
              'America/Paramaribo' => '(GMT-3:00) Paramaribo (Suriname Time)',
              'America/Recife' => '(GMT-3:00) Recife (Brasilia Time)',
              'America/Rosario' => '(GMT-3:00) Rosario (Argentine Time)',
              'America/Santarem' => '(GMT-3:00) Santarem (Brasilia Time)',
              'America/Sao_Paulo' => '(GMT-3:00) Sao_Paulo (Brasilia Time)',
              'Antarctica/Rothera' => '(GMT-3:00) Rothera (Rothera Time)',
              'Brazil/East' => '(GMT-3:00) East (Brasilia Time)',
              'America/Noronha' => '(GMT-2:00) Noronha (Fernando de Noronha Time)',
              'Atlantic/South_Georgia' => '(GMT-2:00) South_Georgia (South Georgia Standard Time)',
              'Brazil/DeNoronha' => '(GMT-2:00) DeNoronha (Fernando de Noronha Time)',
              'America/Scoresbysund' => '(GMT-1:00) Scoresbysund (Eastern Greenland Time)',
              'Atlantic/Azores' => '(GMT-1:00) Azores (Azores Time)',
              'Atlantic/Cape_Verde' => '(GMT-1:00) Cape_Verde (Cape Verde Time)',
              'Africa/Abidjan' => '(GMT+0:00) Abidjan (Greenwich Mean Time)',
              'Africa/Accra' => '(GMT+0:00) Accra (Ghana Mean Time)',
              'Africa/Bamako' => '(GMT+0:00) Bamako (Greenwich Mean Time)',
              'Africa/Banjul' => '(GMT+0:00) Banjul (Greenwich Mean Time)',
              'Africa/Bissau' => '(GMT+0:00) Bissau (Greenwich Mean Time)',
              'Africa/Casablanca' => '(GMT+0:00) Casablanca (Western European Time)',
              'Africa/Conakry' => '(GMT+0:00) Conakry (Greenwich Mean Time)',
              'Africa/Dakar' => '(GMT+0:00) Dakar (Greenwich Mean Time)',
              'Africa/El_Aaiun' => '(GMT+0:00) El_Aaiun (Western European Time)',
              'Africa/Freetown' => '(GMT+0:00) Freetown (Greenwich Mean Time)',
              'Africa/Lome' => '(GMT+0:00) Lome (Greenwich Mean Time)',
              'Africa/Monrovia' => '(GMT+0:00) Monrovia (Greenwich Mean Time)',
              'Africa/Nouakchott' => '(GMT+0:00) Nouakchott (Greenwich Mean Time)',
              'Africa/Ouagadougou' => '(GMT+0:00) Ouagadougou (Greenwich Mean Time)',
              'Africa/Sao_Tome' => '(GMT+0:00) Sao_Tome (Greenwich Mean Time)',
              'Africa/Timbuktu' => '(GMT+0:00) Timbuktu (Greenwich Mean Time)',
              'America/Danmarkshavn' => '(GMT+0:00) Danmarkshavn (Greenwich Mean Time)',
              'Atlantic/Canary' => '(GMT+0:00) Canary (Western European Time)',
              'Atlantic/Faeroe' => '(GMT+0:00) Faeroe (Western European Time)',
              'Atlantic/Faroe' => '(GMT+0:00) Faroe (Western European Time)',
              'Atlantic/Madeira' => '(GMT+0:00) Madeira (Western European Time)',
              'Atlantic/Reykjavik' => '(GMT+0:00) Reykjavik (Greenwich Mean Time)',
              'Atlantic/St_Helena' => '(GMT+0:00) St_Helena (Greenwich Mean Time)',
              'Europe/Belfast' => '(GMT+0:00) Belfast (Greenwich Mean Time)',
              'Europe/Dublin' => '(GMT+0:00) Dublin (Greenwich Mean Time)',
              'Europe/Guernsey' => '(GMT+0:00) Guernsey (Greenwich Mean Time)',
              'Europe/Isle_of_Man' => '(GMT+0:00) Isle_of_Man (Greenwich Mean Time)',
              'Europe/Jersey' => '(GMT+0:00) Jersey (Greenwich Mean Time)',
              'Europe/Lisbon' => '(GMT+0:00) Lisbon (Western European Time)',
              'Europe/London' => '(GMT+0:00) London (Greenwich Mean Time)',
              'Africa/Algiers' => '(GMT+1:00) Algiers (Central European Time)',
              'Africa/Bangui' => '(GMT+1:00) Bangui (Western African Time)',
              'Africa/Brazzaville' => '(GMT+1:00) Brazzaville (Western African Time)',
              'Africa/Ceuta' => '(GMT+1:00) Ceuta (Central European Time)',
              'Africa/Douala' => '(GMT+1:00) Douala (Western African Time)',
              'Africa/Kinshasa' => '(GMT+1:00) Kinshasa (Western African Time)',
              'Africa/Lagos' => '(GMT+1:00) Lagos (Western African Time)',
              'Africa/Libreville' => '(GMT+1:00) Libreville (Western African Time)',
              'Africa/Luanda' => '(GMT+1:00) Luanda (Western African Time)',
              'Africa/Malabo' => '(GMT+1:00) Malabo (Western African Time)',
              'Africa/Ndjamena' => '(GMT+1:00) Ndjamena (Western African Time)',
              'Africa/Niamey' => '(GMT+1:00) Niamey (Western African Time)',
              'Africa/Porto-Novo' => '(GMT+1:00) Porto-Novo (Western African Time)',
              'Africa/Tunis' => '(GMT+1:00) Tunis (Central European Time)',
              'Africa/Windhoek' => '(GMT+1:00) Windhoek (Western African Time)',
              'Arctic/Longyearbyen' => '(GMT+1:00) Longyearbyen (Central European Time)',
              'Atlantic/Jan_Mayen' => '(GMT+1:00) Jan_Mayen (Central European Time)',
              'Europe/Amsterdam' => '(GMT+1:00) Amsterdam (Central European Time)',
              'Europe/Andorra' => '(GMT+1:00) Andorra (Central European Time)',
              'Europe/Belgrade' => '(GMT+1:00) Belgrade (Central European Time)',
              'Europe/Berlin' => '(GMT+1:00) Berlin (Central European Time)',
              'Europe/Bratislava' => '(GMT+1:00) Bratislava (Central European Time)',
              'Europe/Brussels' => '(GMT+1:00) Brussels (Central European Time)',
              'Europe/Budapest' => '(GMT+1:00) Budapest (Central European Time)',
              'Europe/Copenhagen' => '(GMT+1:00) Copenhagen (Central European Time)',
              'Europe/Gibraltar' => '(GMT+1:00) Gibraltar (Central European Time)',
              'Europe/Ljubljana' => '(GMT+1:00) Ljubljana (Central European Time)',
              'Europe/Luxembourg' => '(GMT+1:00) Luxembourg (Central European Time)',
              'Europe/Madrid' => '(GMT+1:00) Madrid (Central European Time)',
              'Europe/Malta' => '(GMT+1:00) Malta (Central European Time)',
              'Europe/Monaco' => '(GMT+1:00) Monaco (Central European Time)',
              'Europe/Oslo' => '(GMT+1:00) Oslo (Central European Time)',
              'Europe/Paris' => '(GMT+1:00) Paris (Central European Time)',
              'Europe/Podgorica' => '(GMT+1:00) Podgorica (Central European Time)',
              'Europe/Prague' => '(GMT+1:00) Prague (Central European Time)',
              'Europe/Rome' => '(GMT+1:00) Rome (Central European Time)',
              'Europe/San_Marino' => '(GMT+1:00) San_Marino (Central European Time)',
              'Europe/Sarajevo' => '(GMT+1:00) Sarajevo (Central European Time)',
              'Europe/Skopje' => '(GMT+1:00) Skopje (Central European Time)',
              'Europe/Stockholm' => '(GMT+1:00) Stockholm (Central European Time)',
              'Europe/Tirane' => '(GMT+1:00) Tirane (Central European Time)',
              'Europe/Vaduz' => '(GMT+1:00) Vaduz (Central European Time)',
              'Europe/Vatican' => '(GMT+1:00) Vatican (Central European Time)',
              'Europe/Vienna' => '(GMT+1:00) Vienna (Central European Time)',
              'Europe/Warsaw' => '(GMT+1:00) Warsaw (Central European Time)',
              'Europe/Zagreb' => '(GMT+1:00) Zagreb (Central European Time)',
              'Europe/Zurich' => '(GMT+1:00) Zurich (Central European Time)',
              'Africa/Blantyre' => '(GMT+2:00) Blantyre (Central African Time)',
              'Africa/Bujumbura' => '(GMT+2:00) Bujumbura (Central African Time)',
              'Africa/Cairo' => '(GMT+2:00) Cairo (Eastern European Time)',
              'Africa/Gaborone' => '(GMT+2:00) Gaborone (Central African Time)',
              'Africa/Harare' => '(GMT+2:00) Harare (Central African Time)',
              'Africa/Johannesburg' => '(GMT+2:00) Johannesburg (South Africa Standard Time)',
              'Africa/Kigali' => '(GMT+2:00) Kigali (Central African Time)',
              'Africa/Lubumbashi' => '(GMT+2:00) Lubumbashi (Central African Time)',
              'Africa/Lusaka' => '(GMT+2:00) Lusaka (Central African Time)',
              'Africa/Maputo' => '(GMT+2:00) Maputo (Central African Time)',
              'Africa/Maseru' => '(GMT+2:00) Maseru (South Africa Standard Time)',
              'Africa/Mbabane' => '(GMT+2:00) Mbabane (South Africa Standard Time)',
              'Africa/Tripoli' => '(GMT+2:00) Tripoli (Eastern European Time)',
              'Asia/Amman' => '(GMT+2:00) Amman (Eastern European Time)',
              'Asia/Beirut' => '(GMT+2:00) Beirut (Eastern European Time)',
              'Asia/Damascus' => '(GMT+2:00) Damascus (Eastern European Time)',
              'Asia/Gaza' => '(GMT+2:00) Gaza (Eastern European Time)',
              'Asia/Istanbul' => '(GMT+2:00) Istanbul (Eastern European Time)',
              'Asia/Jerusalem' => '(GMT+2:00) Jerusalem (Israel Standard Time)',
              'Asia/Nicosia' => '(GMT+2:00) Nicosia (Eastern European Time)',
              'Asia/Tel_Aviv' => '(GMT+2:00) Tel_Aviv (Israel Standard Time)',
              'Europe/Athens' => '(GMT+2:00) Athens (Eastern European Time)',
              'Europe/Bucharest' => '(GMT+2:00) Bucharest (Eastern European Time)',
              'Europe/Chisinau' => '(GMT+2:00) Chisinau (Eastern European Time)',
              'Europe/Helsinki' => '(GMT+2:00) Helsinki (Eastern European Time)',
              'Europe/Istanbul' => '(GMT+2:00) Istanbul (Eastern European Time)',
              'Europe/Kaliningrad' => '(GMT+2:00) Kaliningrad (Eastern European Time)',
              'Europe/Kiev' => '(GMT+2:00) Kiev (Eastern European Time)',
              'Europe/Mariehamn' => '(GMT+2:00) Mariehamn (Eastern European Time)',
              'Europe/Minsk' => '(GMT+2:00) Minsk (Eastern European Time)',
              'Europe/Nicosia' => '(GMT+2:00) Nicosia (Eastern European Time)',
              'Europe/Riga' => '(GMT+2:00) Riga (Eastern European Time)',
              'Europe/Simferopol' => '(GMT+2:00) Simferopol (Eastern European Time)',
              'Europe/Sofia' => '(GMT+2:00) Sofia (Eastern European Time)',
              'Europe/Tallinn' => '(GMT+2:00) Tallinn (Eastern European Time)',
              'Europe/Tiraspol' => '(GMT+2:00) Tiraspol (Eastern European Time)',
              'Europe/Uzhgorod' => '(GMT+2:00) Uzhgorod (Eastern European Time)',
              'Europe/Vilnius' => '(GMT+2:00) Vilnius (Eastern European Time)',
              'Europe/Zaporozhye' => '(GMT+2:00) Zaporozhye (Eastern European Time)',
              'Africa/Addis_Ababa' => '(GMT+3:00) Addis_Ababa (Eastern African Time)',
              'Africa/Asmara' => '(GMT+3:00) Asmara (Eastern African Time)',
              'Africa/Asmera' => '(GMT+3:00) Asmera (Eastern African Time)',
              'Africa/Dar_es_Salaam' => '(GMT+3:00) Dar_es_Salaam (Eastern African Time)',
              'Africa/Djibouti' => '(GMT+3:00) Djibouti (Eastern African Time)',
              'Africa/Kampala' => '(GMT+3:00) Kampala (Eastern African Time)',
              'Africa/Khartoum' => '(GMT+3:00) Khartoum (Eastern African Time)',
              'Africa/Mogadishu' => '(GMT+3:00) Mogadishu (Eastern African Time)',
              'Africa/Nairobi' => '(GMT+3:00) Nairobi (Eastern African Time)',
              'Antarctica/Syowa' => '(GMT+3:00) Syowa (Syowa Time)',
              'Asia/Aden' => '(GMT+3:00) Aden (Arabia Standard Time)',
              'Asia/Baghdad' => '(GMT+3:00) Baghdad (Arabia Standard Time)',
              'Asia/Bahrain' => '(GMT+3:00) Bahrain (Arabia Standard Time)',
              'Asia/Kuwait' => '(GMT+3:00) Kuwait (Arabia Standard Time)',
              'Asia/Qatar' => '(GMT+3:00) Qatar (Arabia Standard Time)',
              'Europe/Moscow' => '(GMT+3:00) Moscow (Moscow Standard Time)',
              'Europe/Volgograd' => '(GMT+3:00) Volgograd (Volgograd Time)',
              'Indian/Antananarivo' => '(GMT+3:00) Antananarivo (Eastern African Time)',
              'Indian/Comoro' => '(GMT+3:00) Comoro (Eastern African Time)',
              'Indian/Mayotte' => '(GMT+3:00) Mayotte (Eastern African Time)',
              'Asia/Tehran' => '(GMT+3:30) Tehran (Iran Standard Time)',
              'Asia/Baku' => '(GMT+4:00) Baku (Azerbaijan Time)',
              'Asia/Dubai' => '(GMT+4:00) Dubai (Gulf Standard Time)',
              'Asia/Muscat' => '(GMT+4:00) Muscat (Gulf Standard Time)',
              'Asia/Tbilisi' => '(GMT+4:00) Tbilisi (Georgia Time)',
              'Asia/Yerevan' => '(GMT+4:00) Yerevan (Armenia Time)',
              'Europe/Samara' => '(GMT+4:00) Samara (Samara Time)',
              'Indian/Mahe' => '(GMT+4:00) Mahe (Seychelles Time)',
              'Indian/Mauritius' => '(GMT+4:00) Mauritius (Mauritius Time)',
              'Indian/Reunion' => '(GMT+4:00) Reunion (Reunion Time)',
              'Asia/Kabul' => '(GMT+4:30) Kabul (Afghanistan Time)',
              'Asia/Aqtau' => '(GMT+5:00) Aqtau (Aqtau Time)',
              'Asia/Aqtobe' => '(GMT+5:00) Aqtobe (Aqtobe Time)',
              'Asia/Ashgabat' => '(GMT+5:00) Ashgabat (Turkmenistan Time)',
              'Asia/Ashkhabad' => '(GMT+5:00) Ashkhabad (Turkmenistan Time)',
              'Asia/Dushanbe' => '(GMT+5:00) Dushanbe (Tajikistan Time)',
              'Asia/Karachi' => '(GMT+5:00) Karachi (Pakistan Time)',
              'Asia/Oral' => '(GMT+5:00) Oral (Oral Time)',
              'Asia/Samarkand' => '(GMT+5:00) Samarkand (Uzbekistan Time)',
              'Asia/Tashkent' => '(GMT+5:00) Tashkent (Uzbekistan Time)',
              'Asia/Yekaterinburg' => '(GMT+5:00) Yekaterinburg (Yekaterinburg Time)',
              'Indian/Kerguelen' => '(GMT+5:00) Kerguelen (French Southern & Antarctic Lands Time)',
              'Indian/Maldives' => '(GMT+5:00) Maldives (Maldives Time)',
              'Asia/Calcutta' => '(GMT+5:30) Calcutta (India Standard Time)',
              'Asia/Colombo' => '(GMT+5:30) Colombo (India Standard Time)',
              'Asia/Kolkata' => '(GMT+5:30) Kolkata (India Standard Time)',
              'Asia/Katmandu' => '(GMT+5:45) Katmandu (Nepal Time)',
              'Antarctica/Mawson' => '(GMT+6:00) Mawson (Mawson Time)',
              'Antarctica/Vostok' => '(GMT+6:00) Vostok (Vostok Time)',
              'Asia/Almaty' => '(GMT+6:00) Almaty (Alma-Ata Time)',
              'Asia/Bishkek' => '(GMT+6:00) Bishkek (Kirgizstan Time)',
              'Asia/Dacca' => '(GMT+6:00) Dacca (Bangladesh Time)',
              'Asia/Dhaka' => '(GMT+6:00) Dhaka (Bangladesh Time)',
              'Asia/Novosibirsk' => '(GMT+6:00) Novosibirsk (Novosibirsk Time)',
              'Asia/Omsk' => '(GMT+6:00) Omsk (Omsk Time)',
              'Asia/Qyzylorda' => '(GMT+6:00) Qyzylorda (Qyzylorda Time)',
              'Asia/Thimbu' => '(GMT+6:00) Thimbu (Bhutan Time)',
              'Asia/Thimphu' => '(GMT+6:00) Thimphu (Bhutan Time)',
              'Indian/Chagos' => '(GMT+6:00) Chagos (Indian Ocean Territory Time)',
              'Asia/Rangoon' => '(GMT+6:30) Rangoon (Myanmar Time)',
              'Indian/Cocos' => '(GMT+6:30) Cocos (Cocos Islands Time)',
              'Antarctica/Davis' => '(GMT+7:00) Davis (Davis Time)',
              'Asia/Bangkok' => '(GMT+7:00) Bangkok (Indochina Time)',
              'Asia/Ho_Chi_Minh' => '(GMT+7:00) Ho_Chi_Minh (Indochina Time)',
              'Asia/Hovd' => '(GMT+7:00) Hovd (Hovd Time)',
              'Asia/Jakarta' => '(GMT+7:00) Jakarta (West Indonesia Time)',
              'Asia/Krasnoyarsk' => '(GMT+7:00) Krasnoyarsk (Krasnoyarsk Time)',
              'Asia/Phnom_Penh' => '(GMT+7:00) Phnom_Penh (Indochina Time)',
              'Asia/Pontianak' => '(GMT+7:00) Pontianak (West Indonesia Time)',
              'Asia/Saigon' => '(GMT+7:00) Saigon (Indochina Time)',
              'Asia/Vientiane' => '(GMT+7:00) Vientiane (Indochina Time)',
              'Indian/Christmas' => '(GMT+7:00) Christmas (Christmas Island Time)',
              'Antarctica/Casey' => '(GMT+8:00) Casey (Western Standard Time (Australia))',
              'Asia/Brunei' => '(GMT+8:00) Brunei (Brunei Time)',
              'Asia/Choibalsan' => '(GMT+8:00) Choibalsan (Choibalsan Time)',
              'Asia/Chongqing' => '(GMT+8:00) Chongqing (China Standard Time)',
              'Asia/Chungking' => '(GMT+8:00) Chungking (China Standard Time)',
              'Asia/Harbin' => '(GMT+8:00) Harbin (China Standard Time)',
              'Asia/Hong_Kong' => '(GMT+8:00) Hong_Kong (Hong Kong Time)',
              'Asia/Irkutsk' => '(GMT+8:00) Irkutsk (Irkutsk Time)',
              'Asia/Kashgar' => '(GMT+8:00) Kashgar (China Standard Time)',
              'Asia/Kuala_Lumpur' => '(GMT+8:00) Kuala_Lumpur (Malaysia Time)',
              'Asia/Kuching' => '(GMT+8:00) Kuching (Malaysia Time)',
              'Asia/Macao' => '(GMT+8:00) Macao (China Standard Time)',
              'Asia/Macau' => '(GMT+8:00) Macau (China Standard Time)',
              'Asia/Makassar' => '(GMT+8:00) Makassar (Central Indonesia Time)',
              'Asia/Manila' => '(GMT+8:00) Manila (Philippines Time)',
              'Asia/Shanghai' => '(GMT+8:00) Shanghai (China Standard Time)',
              'Asia/Singapore' => '(GMT+8:00) Singapore (Singapore Time)',
              'Asia/Taipei' => '(GMT+8:00) Taipei (China Standard Time)',
              'Asia/Ujung_Pandang' => '(GMT+8:00) Ujung_Pandang (Central Indonesia Time)',
              'Asia/Ulaanbaatar' => '(GMT+8:00) Ulaanbaatar (Ulaanbaatar Time)',
              'Asia/Ulan_Bator' => '(GMT+8:00) Ulan_Bator (Ulaanbaatar Time)',
              'Asia/Urumqi' => '(GMT+8:00) Urumqi (China Standard Time)',
              'Australia/Perth' => '(GMT+8:00) Perth (Western Standard Time (Australia))',
              'Australia/West' => '(GMT+8:00) West (Western Standard Time (Australia))',
              'Australia/Eucla' => '(GMT+8:45) Eucla (Central Western Standard Time (Australia))',
              'Asia/Dili' => '(GMT+9:00) Dili (Timor-Leste Time)',
              'Asia/Jayapura' => '(GMT+9:00) Jayapura (East Indonesia Time)',
              'Asia/Pyongyang' => '(GMT+9:00) Pyongyang (Korea Standard Time)',
              'Asia/Seoul' => '(GMT+9:00) Seoul (Korea Standard Time)',
              'Asia/Tokyo' => '(GMT+9:00) Tokyo (Japan Standard Time)',
              'Asia/Yakutsk' => '(GMT+9:00) Yakutsk (Yakutsk Time)',
              'Australia/Adelaide' => '(GMT+9:30) Adelaide (Central Standard Time (South Australia))',
              'Australia/Broken_Hill' => '(GMT+9:30) Broken_Hill (Central Standard Time (South New South Wales))',
              'Australia/Darwin' => '(GMT+9:30) Darwin (Central Standard Time (Northern Territory))',
              'Australia/North' => '(GMT+9:30) North (Central Standard Time (Northern Territory))',
              'Australia/South' => '(GMT+9:30) South (Central Standard Time (South Australia))',
              'Australia/Yancowinna' => '(GMT+9:30) Yancowinna (Central Standard Time (South New South Wales))',
              'Antarctica/DumontDUrville' => '(GMT+10:00) DumontDUrville (Dumont-d\'Urville Time)',
              'Asia/Sakhalin' => '(GMT+10:00) Sakhalin (Sakhalin Time)',
              'Asia/Vladivostok' => '(GMT+10:00) Vladivostok (Vladivostok Time)',
              'Australia/ACT' => '(GMT+10:00) ACT (Eastern Standard Time (New South Wales))',
              'Australia/Brisbane' => '(GMT+10:00) Brisbane (Eastern Standard Time (Queensland))',
              'Australia/Canberra' => '(GMT+10:00) Canberra (Eastern Standard Time (New South Wales))',
              'Australia/Currie' => '(GMT+10:00) Currie (Eastern Standard Time (New South Wales))',
              'Australia/Hobart' => '(GMT+10:00) Hobart (Eastern Standard Time (Tasmania))',
              'Australia/Lindeman' => '(GMT+10:00) Lindeman (Eastern Standard Time (Queensland))',
              'Australia/Melbourne' => '(GMT+10:00) Melbourne (Eastern Standard Time (Victoria))',
              'Australia/NSW' => '(GMT+10:00) NSW (Eastern Standard Time (New South Wales))',
              'Australia/Queensland' => '(GMT+10:00) Queensland (Eastern Standard Time (Queensland))',
              'Australia/Sydney' => '(GMT+10:00) Sydney (Eastern Standard Time (New South Wales))',
              'Australia/Tasmania' => '(GMT+10:00) Tasmania (Eastern Standard Time (Tasmania))',
              'Australia/Victoria' => '(GMT+10:00) Victoria (Eastern Standard Time (Victoria))',
              'Australia/LHI' => '(GMT+10:30) LHI (Lord Howe Standard Time)',
              'Australia/Lord_Howe' => '(GMT+10:30) Lord_Howe (Lord Howe Standard Time)',
              'Asia/Magadan' => '(GMT+11:00) Magadan (Magadan Time)',
              'Antarctica/McMurdo' => '(GMT+12:00) McMurdo (New Zealand Standard Time)',
              'Antarctica/South_Pole' => '(GMT+12:00) South_Pole (New Zealand Standard Time)',
              'Asia/Anadyr' => '(GMT+12:00) Anadyr (Anadyr Time)',
              'Asia/Kamchatka' => '(GMT+12:00) Kamchatka (Petropavlovsk-Kamchatski Time)'
          );

              ?>
          <div class="modal-body">
              <div class="form-group">
                  <label class="form-label-color title-label-w">TimeZone</label>
                  
            
                  <select name="timezone" class="lang_input">
                      @if(!empty($profile_data->timezone) && !empty($timezones[$profile_data->timezone]))
                      <option value="{{$timezones[$profile_data->timezone]}}" selected="selected">
                     	 {{$timezones[$profile_data->timezone]}}
                      </option> 
                      @endif
                      @foreach($timezones as $key=>$value)
                          <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
       <div class="modal-body">
           <div class="form-group">
          <label class="form-label-color title-label-w">City</label>
          <input type="text" name="city" id="city" class="lang_input" value="@if(!empty($profile_data)){{ $profile_data->city }}@endif">
      </div>
       </div>
        
        <div class="modal-body">
             <div class="form-group">
          <label class="form-label-color title-label-w">Hourly Rate</label>
          <input class="lang_input" type="text" name="hourly_rate" id="hourly_rate" value="@if(!empty($profile_data)){{ $profile_data->hourly_rate }}@endif">
           <span>Total amount the client will see.</span>
           </div>
        </div>
        <div class="modal-body">
            <div class="form-group">
          <label class="form-label-color title-label-w">{{$job_fee}}% Service Fee.</label>
          <input type="text" readonly="readonly" class="lang_input" name="service_fee" id="service_fee" value="@if(!empty($profile_data->hourly_rate)){{ $profile_data->hourly_rate*$job_fee/100 }}@endif">
          <!-- <div id="service_fee"></div> -->
        </div>
        </div>
        <div class="modal-body">
            <div class="form-group">
          <label class="form-label-color title-label-w">You'll be paid</label>
          <input readonly="readonly"  type="text" class="lang_input" name="will_be_paid" id="will_be_paid" value="@if(!empty($profile_data->hourly_rate)){{ $profile_data->hourly_rate-($profile_data->hourly_rate*$job_fee/100) }}@endif">
            <span>The estimated amount you'll receive after service fees.</span>
                <input type="hidden" id="job_charges" value="{{$job_fee}}" readonly>
        </div>
        </div>
        <div class="modal-footer">
            <a href="" class="btn btn-default" data-dismiss="modal">Cancel</a>
            <button type="submit" class="btn btn-default btn-color">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>