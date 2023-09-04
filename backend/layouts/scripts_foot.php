  <!-- Vendor JS Files -->
  <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" referrerpolicy="no-referrer"></script>
  <script src="/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/assets/vendor/quill/quill.min.js"></script>
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

  <script>
  	String.prototype.strLimit = function(limit, end = '...') {
  		return this.length > limit ? this.substring(0, limit) + end : this;
  	}

  	function addEventListenerClass(forClass, ev, callback) {
  		document.addEventListener(ev, function(event) {
  			let target = null;
  			if (event.target.classList.contains(forClass)) {
  				target = event.target;
  			}
  			if (event.target.closest('.' + forClass)) {
  				target = event.target.closest('.' + forClass);
  			}
  			if (!target) {
  				return;
  			}
  			event.preventDefault();
  			callback.call(target, event);
  		});
  	}
  	function addEventListenerId(forId, ev, callback) {
  		document.addEventListener(ev, function(event) {
  			let target = null;
  			if (event.target.id === forId) {
  				target = event.target;
  			}
  			if (event.target.closest('#' + forId)) {
  				target = event.target.closest('#' + forId);
  			}
  			if (!target) {
  				return;
  			}
  			event.preventDefault();
  			callback.call(target, event);
  		});
  	}
  </script>
  </body>

  </html>