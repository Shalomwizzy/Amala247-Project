@extends('layouts.app')

@section('content')
<!-- FOOD-MENU -->
<section class="menu-body">
  <header  class="text-center food-menu">FOOD MENU</header>
 
  <div class="display-style container row">
     <!-- SWALLOW SECTION -->
  <div class="swallow-list col-lg-4 col-md-6 mb-3">
    <table>
      <thead>
        <h2>SWALLOWS <img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">AMALA</a></td>
        
          <td class="food-price"> &#x20A6;150</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">POUNDED YAM</a></td>
        
          <td class="food-price"> &#x20A6;250</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">SEMO</a></td>
        
          <td class="food-price"> &#x20A6;200</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">EBA</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

      </tbody>
    </table>
  </div>

 <!-- BREAKFAST SECTION -->
  <div class="breakfast-list col-lg-4 col-md-6 mb-3 ">  
    <table>
      <thead>
        <h2>BREAKFAST <img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">BOILED YAM</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">PLANTAIN</a></td>
        
          <td class="food-price"> &#x20A6;300</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">SALAD</a></td>
        
          <td class="food-price"> &#x20A6;300</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">EGG</a></td>
        
          <td class="food-price"> &#x20A6;200</td>
        </tr>

      </tbody>
    </table>
  </div>

  <!-- MEAL SECTION -->

  <div class="meal-list col-lg-4 col-md-6 mb-3">  
    <table>
      <thead>
        <h2>MEALS <img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">JOLLOF RICE</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">FRIED RICE</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">RICE & BEANS</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">WHITE RICE</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">COCONUT RICE</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">VILLAGE RICE</a></td>
        
          <td class="food-price"> &#x20A6;800</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">PORRIDGE YAM</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">PORRIDGE BEANS</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">SPAGHETTI</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">EWA AGOYIN</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">OFEDA RICE</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">MOIMOI</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

      </tbody>
    </table>
  </div>

  <!-- SOUP SECTION -->

  <div class="soup-list col-lg-4 col-md-6 mb-3">  
    <table>
      <thead>
        <h2>SOUPS <img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">EGUSI</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">VEGETABLE</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">EDIKA IKONG</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">OGBONO</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

      </tbody>
    </table>
  </div>

 <!--PROTEIN SECTION  -->

  <div class="protein-list col-lg-4 col-md-6 mb-3">  
    <table>
      <thead>
        <h2>PROTEIN <img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">KPOMO</a></td>
        
          <td class="food-price"> &#x20A6;300</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">BEEF</a></td>
        
          <td class="food-price"> &#x20A6;300</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">ASSORTED</a></td>
        
          <td class="food-price"> &#x20A6;300</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">GOAT MEAT</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">TITUS FISH</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">TUKREY</a></td>
        
          <td class="food-price"> &#x20A6;1800</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">CHICKEN</a></td>
        
          <td class="food-price"> &#x20A6;1800</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">SNAIL</a></td>
        
          <td class="food-price"> &#x20A6;1500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">PANLA FISH</a></td>
        
          <td class="food-price"> &#x20A6;2500</td>
        </tr>

      </tbody>
    </table>
  </div>

  <!-- SAUCE SECTION -->

  <div class="sauce-list col-lg-4 col-md-6 mb-3">  
    <table>
      <thead>
        <h2>SAUCE<img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">OFADA SAUCE</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">EGG SAUCE</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">FISH SAUCE</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

      </tbody>
    </table>
  </div>
<!-- DRINK SECTION -->
  <div class="drink-list col-lg-6 col-md-6 mb-3 ">  
    <table>
      <thead>
        <h2>DRINKS <img src="assets/images/main logo-edit.png" alt="" width="50"></h2>
        <tr>
          <!-- <th>FOOD</th>
          <th>Price</th> -->
        </tr>
      </thead>
      <tbody>
        <tr><h2 class="hide">Price</h2>
          <td class="food-name"> <a title="AMALA" href="#">WATER</a></td>
        
          <td class="food-price"> &#x20A6;200</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="POUNDED YAM" href="#">COKE</a></td>
        
          <td class="food-price"> &#x20A6;500</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="SEMO" href="#">FANTA</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">SPRITE</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">MIRINDA</a></td>
        
          <td class="food-price"> &#x20A6;200</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">ZOBO</a></td>
        
          <td class="food-price"> &#x20A6;700</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">TIGER NUT</a></td>
        
          <td class="food-price"> &#x20A6;1200</td>
        </tr>

        <tr>
          <td class="food-name"> <a title="EBA" href="#">FRUIT JUICE</a></td>
        
          <td class="food-price"> &#x20A6;1000</td>
        </tr>

        

      </tbody>
    </table>
  </div>
  </div>

</section>

@endsection