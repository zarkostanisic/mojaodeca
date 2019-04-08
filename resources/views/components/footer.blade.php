<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-xs-12">
				<div class="footer-box">
					<img src="{{asset('img/logo2.png')}}" alt="footer logo image">
					<p class="footer-opis">Moja Odeća je sajt specijalizovan za sve vrste oglasa kada je u pitanju garderoba. Mi smo mesto na kome mozete očistiti orman ili ga napuniti novim komadima odeće. Prodajte, kupite ili zamenite odeću sa drugim korisnicima, i sve to u direktnoj komunikaciji sa korisnicima. Moja Odeća sajt je tu da spoji kupce i prodavce i da na jednom mestu pronadjete sve sto Vam je potrebno da bi ste obnovili garderobu. Brzo, besplatno i lako upravljajte oglasima koje vi postavite.</p>
					<p  class="footer-opis" style="color: #000;"> !  Dodavanje oglasa je potpuno besplatno, te nismo odgovorani za sadržaj koji se nalazi na portalu vec svu odgovornost prihvata lice koje je dodalo oglas. </p>
				</div>
			</div>
			<div class="col-md-7 col-xs-12">
				<div class="col-md-4">
					<h3>Prečice</h3>
					<ul class="footer-nav">
						<li><a href="/admin/user">Moji oglasi</a></li>
						<li><a href="/about">O nama</a></li>
						<li><a href="/uslovi">Uslovi korišćenja</a></li>
						<li><a href="https://www.facebook.com/mojaodecaa">Facebook stranica</a></li> 

					</ul>
					<h3>Društvene mreže</h3>
					<ul class="footer-nav">
						<li><a href="https://www.instagram.com/mojaodeca/" style="color: #000;font-size: 14px;">Instagram</a></li> 
						<li><a href="https://www.facebook.com/mojaodecaa/" style="color: #000;font-size: 14px;">Facebook</a></li> 
					</ul>
				</div>
				
				<div class="col-md-4">
					<h3>Kategorije</h3>
					<ul class="footer-nav">
						@foreach($categories as $category)
							<li><a href="/{{urlencode($category->name)}}">{{$category->name}}</a></li>
						@endforeach
					</ul>
				</div>
					
				<div class="col-md-4">
					<h3>Kontakt</h3>
					<ul class="footer-nav">
						<li>Ukoliko imate problem ili predlog, podelite to sa nama  jer želimo da napredujemo zajedno. <hr><a href="mailto:mojaodeca.info@gmail.com" style="color: #000;font-size: 14px;">mojaodeca.info@gmail.com</a></li> 
					</ul>
				</div>

			</div>
		</div>
	</div>
	<div id="copyright">
		<div class="container">
			<p>Copyright © 2018 by Moja Odeca. All rights reserved.</p>
		</div>
	</div>
</div>
