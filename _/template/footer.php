		</main>
		</div>
		<!--chiude container-->

		<footer>
			<p class="footer-copyright">&copy;2016-<?php echo date('Y'); ?> Marto &amp; Taillefert - Tutti i diritti riservati</p>
			<p class="footer-copyright">Con i dovuti ringraziamenti a Orelli &amp; Mossi</p>
			<br>
			<p><?php if (isset($_SESSION['username'])) {
						echo "Sei loggato come " . $_SESSION['nome'] . " " . $_SESSION['cognome'] . " - <a class='button' href='actions/closeSession.php'>Logout</a>";
					} ?></p>
		</footer>


		<script> 
		document.addEventListener('DOMContentLoaded', () => {
		const universe = document.getElementById('main'); 
		const isMobile = window.innerWidth <= 768;
		console.log("ciao")
		//Prima funzione per fare le stelle di base 
		function createStars(container) {
        const starCount = 100; 
        for (let i = 0; i < starCount; i++) {
            const star = document.createElement('div');
            star.classList.add('star');

			star.style.top = `${Math.random() * 100}%`;
            star.style.left = `${Math.random() * 100}%`;

			const size = isMobile ? (Math.random() * 1 + 0.5) : (Math.random() * 5 + 1);
            star.style.top = `${Math.random() * window.innerWidth*2}px`;
            star.style.left = `${Math.random() * window.innerHeight*2}px`;

			const duration = Math.random() * 5 + 3;
            star.style.animationDuration = `${duration}s`;

			const colors = ['white', '#fbf1d1', '#3d85c6'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            star.style.backgroundColor = randomColor;
			
			container.appendChild(star);
		}}
		//Seconda funzione per fare le stelle cadenti 
		function createStarss(container) {
        const starCount = 25;
        for (let i = 0; i < starCount; i++) {
            const scia = document.createElement('div');
			const puntodellasc = document.createElement('div');

            scia.classList.add('shooting-star');
            puntodellasc.classList.add('starpoint');

			scia.style.top = `${Math.random() * document.documentElement.clientWidth*2}px`;
            scia.style.left = `${Math.random() * document.documentElement.clientHeight*2}px`;
			
			puntodellasc.style.top = `${parseInt(scia.style.top, 10) + 82.5}px`;
			puntodellasc.style.left = `${parseInt(scia.style.left, 10) - 36.7}px`;

			const duration = Math.random() * 20 + 3;
            scia.style.animationDuration = `${duration}s`;
			puntodellasc.style.animationDuration = `${duration}s`;

			const colors = ['white'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
			puntodellasc.style.backgroundColor = 'white';

			container.appendChild(scia);
			container.appendChild(puntodellasc);
		}}

		
		createStars(universe);
		setInterval(createStarss(universe), 1000);
		
	})
		

 	</script>

	
	<script>
		document.getElementById('togglePassword').addEventListener('click', function() {
		const passwordField = document.getElementById('password');
		const eyeIcon = document.getElementById('togglePassword');
		
		// Se la password è nascosta, mostriamola e cambiamo l'icona
		if (passwordField.type === 'password') {
			passwordField.type = 'text';
			eyeIcon.textContent = '🙈'; // Cambia l'icona a una chiave, o altro
		} else {
			passwordField.type = 'password';
			eyeIcon.textContent = '👁️'; // Ripristina l'icona dell'occhio
		}
	});

		</script>

		</body>

		</html>