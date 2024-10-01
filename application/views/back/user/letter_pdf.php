<meta charset="UTF-8">
<style>
    body {
        font-family: "shruti";
		font-size:19px;
		font-weight:normal;
    }
	body .second_table{
        font-family: "shruti";
		font-size:18px;
		font-weight:normal;
    }
	
	.header_center{
		text-align: center;
	}
	.header_right{
		text-align: right;
	}
	.header_left{
		text-align: left;
	}
</style>
<?php


$date = date("d-m-Y H:i:s",strtotime($user_detail['created_date']));
$html = '
	<section style="width: 100%">
	<body>
		<table border="" >
			<tr style="width:100%">
				<td  colspan="2"><img src="'.base_url().'uploads/other_images/akhand_bharat_header.png" style="width:100%;"></td>
			</tr>
			
			<tr style="width:100%">
				<td colspan="2"  class="header_center"><p>અખંડ ભારત દૈનિક ન્યુઝ ગાંધીનગર<br>ગુજરાત</p></td>
			</tr>
			
			<tr style="width:100%">
				<td colspan="2" class="header_right"><p>પત્ર ક્રમાંક :-2024000'.$user_detail['id'].' </p><p>તારીખ :- '.$date.'</p></td>
			</tr>
			<tr style="width:100%">
				<td  colspan="2" class="header_left"><p>પ્રતિ પોલીસ ઇન્સ્પેક્ટર શ્રી </p><p>'.$user_detail['police_station_name'].' પોલીસ સ્ટેશન</p><br></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr style="width:100%">
				<td  colspan="2" class="header_left" ><p>વિષય :- પત્રકાર વિશે જાણ કરવા બાબત</p><p>મહોદય શ્રી</p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" style="width:100%">&nbsp;</td>
			</tr>
			<tr style="width:100%">
				<td  colspan="2" class="header_left" style="width:100%"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;સવિનય જય ભારત સહ જણાવાનું કે અમારા ઉપરોક્ત ન્યુઝ પરિવાર માં આપ શ્રી ના પોલીસ સ્ટેશન ની હદમાં આવેલા રહેઠાણમાં રહેતા.</p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left" style="width:100%"><p>નામ  :- <u>'.$user_detail['name'].'</u></p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left" style="width:100%"><p>મોબાઈલ નંબર  :- <u> '.$user_detail['mobile'].'</u></p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left"><p>એડ્રેસ  :-  <u>'.$user_detail['address'].'</u></p></td>
			</tr>
		
			<tr style="width:100%">
				<td colspan="2"  class="header_left" ><p>ને માનદ પત્રકાર તરીકે નિમણૂક કરેલ છે. જેની જાણ રૂપ. </p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left" style="width:100%"><p>આ પત્ર અખંડ ભારત ન્યૂઝ પેપર કાર્યાલયથી આપશ્રી ની જાણ સારું મોકલવામાં આવેલ છે. </p></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			
				<tr style="width:100%">
				<td  class="header_center" style="width:50%" ><p><img   src="'.base_url().'uploads/other_images/signature.png" style="height:50px;width:150px;"></p></td>
				<td class="header_center" style="width:50%"><p><img   src="'.base_url().'uploads/other_images/mantri_signature.png" style="height:50px;width:150px;"></p></td>
			</tr>
	<tr style="width:100%">
				<td  class="header_center" style="width:50%" ><p>તંત્રી </p></td>
				<td class="header_center" style="width:50%"><p>મેનેજીંગ તંત્રી</p></td>
			</tr>

	<tr style="width:100%">
				<td  class="header_center" style="width:50%" ><p >રૂપસિંહ તેતરવાલ</p></td>
				<td class="header_center" style="width:50%"><p>શ્રી બાબુલાલ એસ. પટેલ.</p></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			
			
			
			<tr>
			<td colspan="2"><img src="'.base_url().'uploads/other_images/akhand_bharat_middle.png" style="width:100%;"></td>
			</tr>
			<tbody>
				
			</tbody>
		</table>
		
		<table border="" class="second_table" >
			<tr style="width:100%">
				<td  colspan="2"><img src="'.base_url().'uploads/other_images/akhand_bharat_header.png" style="width:100%;"></td>
			</tr>
			
		<tr style="width:100%">
				<td colspan="2"  class="header_center"><p>અખંડ ભારત દૈનિક ન્યુઝ ગાંધીનગર - ગુજરાત</p></td>
			</tr>
			
		<tr style="width:100%">
			<td colspan="2" class="header_right"><p>માનદ્દ નિમણૂક પત્ર  :- ABD2024000'.$user_detail['id'].'</p><p>તારીખ :-'.$date.' </p><p>પત્ર ક્રમાંક : 2024000'.$user_detail['id'].'</p></td>
			</tr>
			
			
			<tr style="width:100%">
				<td  colspan="2" class="header_left" ><p>પ્રતિ શ્રી,  <u>'.$user_detail['name'].'</u></p></td>
			</tr>
			
			<tr style="width:100%">
				<td  colspan="2" class="header_left" style="width:100%"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;આપ શ્રી ને અખંડ ભારત ન્યુઝ પરિવારમાં જોડાવા બદલ અભિનંદન પાઠવીએ છીએ.આપ શ્રી ને નીચે મુજબની શરતોએ નિમણૂક પત્ર આપીએ છીએ.</p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_center" style="width:100%"><p><b><span style="color:#FF5733;">AKHAND </span> <span style="color:#000"> BHARAT </span></b></p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left" style="width:100%"><p>1. સદર નિમણૂક બિલકુલ માનદ ધોરણે આપીએ છીએ.</p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left"><p>2. સદર નિમણૂક પત્રકાર તરીકે ની અપેક્ષાઓ સાથે શિસ્ત ના ધોરણો સ્વીકાર કરવાનીશરતે જ માન્ય રહેશે.</p></td>
			</tr>
			<tr>
				<td colspan="2">3. સદર નિમણૂક બાદ અખંડ ભારત ન્યુઝ પરિવાર ની તમામ સુચનાઓ કે જેમાં પરિસ્થિતિમુજબ થતા ફેરફાર ને અમલમાં મૂકવાના રહેશે.</td>
			</tr>
			<tr style="width:100%">
				<td colspan="2"  class="header_left" ><p>4. ધંધાકીય જાહેરાતો મા આપને મળવા પાત્ર રકમ આપના બેન્ક ખાતામાં સીધા જ ચુકવણીકરવામાં આવશે </p></td>
			</tr>
			<tr style="width:100%">
				<td colspan="2" class="header_left" style="width:100%"><p>5. આપના કાર્યક્ષેત્ર ના પોલીસ સ્ટેશનમાં આપનું વેરીફીકેશન અત્રે થી કરવામાં આવશે તથા આપનાનામની નોંધણી કરવામાં આવશે </p></td>
			</tr>
			<tr>
				<td colspan="2">6. અસામાન્ય પરિસ્થિતિમાં સીધા જ અત્રે ની કચેરીમાં ફોન થી સંપકૅ કરી ને સમાચાર બનાવવા.</td>
			</tr>
			<tr>
				<td colspan="2">7. આપશ્રી દ્વારા વોટ્સએપ પર જ સમાચાર અત્રે સમય મર્યાદામાં મોકલી આપવા રહેશે.</td>
			</tr>
			<tr>
				<td colspan="2">8. આપે મોકલાવેલ સમાચારની ક્રમાનુસારતા,અગત્યતા, અસરકારકતા વગેરે ને ધ્યાને લઈ ને જ છાપવામાં આવશે.</td>
			</tr>
			
			<tr>
				<td colspan="2">9. સદર નિમણૂક અખંડ ભારત ન્યુઝ પરિવાર ની શરતોએ અમલ કરતા રહેશે. ગેરશિસ્ત અથવાઅન્ય અનિવાર્ય સંજોગોમાં આપોઆપ નિમણૂક રદ્દ કરવામાં આવશે.</td>
			</tr>
			
			<tr>
				<td colspan="2">10. જરૂર જણાયેઅથવા અત્રે થી જણાવવામાં આવે ત્યારે આપશ્રીએ પ્રેસ કાર્યાલય ખાતે રૂબરૂમાં પણ આવવું પડશે તેની ખાસ નોંધ લેવી.</td>
			</tr>
			<tr>
				<td colspan="2">11. આપના દ્વારા મોકલવામાં આવેલા સમાચારો / માહિતીનીસત્યતા આપની વ્યક્તિગતજવાબદારી રહેશે, જેમાં અખંડ ભારત ડેઇલી ન્યૂઝ પેપરની રહેશે નહિ.</td>
			</tr>
			<tr>
				<td colspan="2" class="header_center">*શુભેચ્છાઓ સાથે*</td>
			</tr>
				<tr style="width:100%">
				<td  class="header_center" style="width:50%" ><p><img   src="'.base_url().'uploads/other_images/signature.png" style="height:30px;width:150px;"></p></td>
				<td class="header_center" style="width:50%"><p><img   src="'.base_url().'uploads/other_images/mantri_signature.png" style="height:30px;width:150px;"></p></td>
			</tr>
	<tr style="width:100%">
				<td  class="header_center" style="width:50%" ><p>તંત્રી </p></td>
				<td class="header_center" style="width:50%"><p>મેનેજીંગ તંત્રી</p></td>
			</tr>

	<tr style="width:100%">
				<td  class="header_center" style="width:50%" ><p >રૂપસિંહ તેતરવાલ</p></td>
				<td class="header_center" style="width:50%"><p>શ્રી બાબુલાલ એસ. પટેલ.</p></td>
			</tr>
			
		
			<tr>
			<td colspan="2"><img src="'.base_url().'uploads/other_images/akhand_bharat_middle.png" style="width:100%;"></td>
			</tr>
			<tbody>
				
			</tbody>
		</table>
</body>
	</section>	
';

	echo $html;

?>