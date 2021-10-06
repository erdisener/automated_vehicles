 <div class="container">
      <div class="row">
        <div class="jumbotron">
          <h1>Otonom Araç Yönetim Sistemi</h1>
          <h2>Uludağ Üniversitesi Endüstri Mühendisliği Bölümü</h2>
        </div>
        <div class="alert">İstek kaydedildi!</div>

        <div class="col-md-6">
          <form id="distance_form">
            <div class="form-group">
              <label>Başlangıç noktası: </label>
              <input
                class="form-control"
                id="orijin_point"
                placeholder="Başlangıç noktası giriniz"
              />
              <input id="origin" name="origin" required="" type="hidden" />
            </div>

            <div class="form-group">
              <label>Varış Noktası: </label>
              <input
                class="form-control"
                id="destination_point"
                placeholder="Varış noktası giriniz"
              />
              <input
                id="destination"
                name="destination"
                required=""
                type="hidden"
              />
            </div>
            <div class="form-group time-range">
              <label>En erken araç talebi: </label>
              <input
                type="time"
                name="earliest"
                id="earliest"
                value="12:00"
              /><label>En geç araç talebi: </label>
              <input type="time" name="latest" id="latest" value="12:00" />
            </div>
            <div class="form-group">
            <label>Araç tipi seçiniz: </label>
              <select name="carType" id="carType">
              <option value="kucuk">Kucuk</option>
              <option value="orta">Orta</option>
              <option value="buyuk">Buyuk</option>
              </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Hesapla" />
            <hr/>
          </form>

          <div id="result">
            <ul class="list-group">
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Başlangıç Noktası - Varış Noktası arası mesafe (km):
                <span
                  id="distance_km"
                  class="badge badge-primary badge-pill"
                ></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Başlangıç Noktası - Varış Noktası arası yolculuk süresi:
                <span
                  id="duration_text"
                  class="badge badge-primary badge-pill"
                ></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Başlangıç Noktası - Varış Noktası arası yolculuk süresi (saniye):
                <span
                  id="duration_sec"
                  class="badge badge-primary badge-pill"
                ></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Başlangıç Noktası:
                <span id="from" class="badge badge-primary badge-pill"></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Başlangıç Noktası enlem-boylam derecesi:
                <span
                  id="fromlatlng"
                  class="badge badge-primary badge-pill"
                ></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Varış Noktası:
                <span id="to" class="badge badge-primary badge-pill"></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                Varış Noktası enlem-boylam derecesi:
                <span
                  id="tolatlng"
                  class="badge badge-primary badge-pill"
                ></span>
              </li>
            </ul>

			<form action="index.php?page=request_add" method="post" > 
				
				
				<input    name="input_orj_to_dest_km"    			id="input_orj_to_dest_km"  		type="text" value="" hidden />
				<input    name="input_duration_text"    	id="input_duration_text"  	type="text" value="" hidden />
				<input    name="input_duration_sec"    	id="input_duration_sec"  	type="text" value="" hidden /> 
				<input    name="input_fromlatlng"    		id="input_fromlatlng"  		type="text" value=""  hidden />
				<input    name="input_tolatlng"    			id="input_tolatlng"  		type="text" value="" hidden />
				<input    name="input_orijin"    	id="input_orijin"  type="text" value="" hidden />
				<input    name="input_destination"    	id="input_destination"  	type="text" value="" hidden /> 
        <input    name="input_earliest_time"  id="input_earliest_time"  		type="text" value="" hidden />
        <input    name="input_latest_time"   	id="input_latest_time"  		type="text" value="" hidden />
        <input    name="input_car_type"    			id="input_car_type"  		type="text" value="" hidden />
        
        <input    name="input_dist_p1_to_orj"    			id="input_dist_p1_to_orj"  		type="text" value="" hidden />
        <input    name="input_dist_p2_to_orj"    			id="input_dist_p2_to_orj"  		type="text" value=""  hidden/>
        <input    name="input_dist_p3_to_orj"    			id="input_dist_p3_to_orj"  		type="text" value="" hidden />

        <input    name="input_duration_p1_to_orj_sec"    			id="input_duration_p1_to_orj_sec"  		type="text" value="" hidden />

        <input    name="input_duration_p2_to_orj_sec"    			id="input_duration_p2_to_orj_sec"  		type="text" value="" hidden />

        <input    name="input_duration_p3_to_orj_sec"    			id="input_duration_p3_to_orj_sec"  		type="text" value="" hidden />

    
        <input    name="input_dest_to_p1"    			id="input_dest_to_p1"  		type="text" value="" hidden />
        <input    name="input_dest_to_p2"    			id="input_dest_to_p2"  		type="text" value="" hidden />
        <input    name="input_dest_to_p3"    			id="input_dest_to_p3"  		type="text" value="" hidden />

        <input    name="input_duration_dest_to_p1_sec"    			id="input_duration_dest_to_p1_sec"  		type="text" value="" hidden />
        <input    name="input_duration_dest_to_p2_sec"    			id="input_duration_dest_to_p2_sec"  		type="text" value="" hidden />
        <input    name="input_duration_dest_to_p3_sec"    			id="input_duration_dest_to_p3_sec"  		type="text" value="" hidden />

        <input type="text" name="input_park_id_1" id="input_park_id_1" value="" hidden/>
        <input type="text" name="input_park_id_2" id="input_park_id_2" value="" hidden/>
        <input type="text" name="input_park_id_3" id="input_park_id_3" value="" hidden/>


        
				<hr>
				<input  class="btn btn-primary"   id="bt_save"  name="bt_save"   type="submit" value="Kaydet"  />
        <hr />

			</form>
		  </div>
        </div>
      </div>
    </div>