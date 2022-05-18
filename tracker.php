<?php

  // Check if order type is Pickup  
  if ($type=="Pickup")
  {
    //check order status     
    if($status=="Order Received")
    { 
?>
      <!-- Pickup order tracker -->
      <div class="step completed"> <!-- If order status level is completed or current -->
        <div class="step-icon-wrap">
           <div class="step-icon"><img src="Images/check.png"/></div>
        </div>
      
        <h4 class="step-title" style="color:#F7833C;">Order Received</h4>
      </div>

      <div class="step">
        <div class="step-icon-wrap">
          <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
        </div>
      
        <h4 class="step-title">Preparing Order</h4>
      </div>

      <div class="step">
        <div class="step-icon-wrap">
          <div class="step-icon"><img style="padding-top:15px; width:48px;" src="Images/store.png"/></div>
        </div>
      
        <h4 class="step-title">Ready For Pickup</h4>
      </div>

      <div class="step">
        <div class="step-icon-wrap">
          <div class="step-icon"><img src="Images/takeaway.png"/></div>
        </div>
      
        <h4 class="step-title">Order Picked Up</h4>
      </div>

    <?php
    }

    elseif ($status=="Preparing Order")
    { 
    ?>
        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/check.png"/></div>
          </div>
        
          <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
         <div class="step-icon-wrap">
           <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
         </div>
   
         <h4 class="step-title" style="color:#00AEC6;">Preparing Order</h4>
        </div>

        <div class="step">
         <div class="step-icon-wrap">
           <div class="step-icon"><img style="padding-top:15px; width:48px;" src="Images/store.png"/></div>
         </div>
         
         <h4 class="step-title">Ready For Pickup</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/takeaway.png"/></div>
          </div>
          
          <h4 class="step-title">Order Picked Up</h4>
        </div>
    
    <?php
    }

    elseif ($status=="Order Is Ready For Pickup")
    { 
    ?>
        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/check.png"/></div>
          </div>
        
          <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:black;">Preparing Order</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px; width:48px;" src="Images/store.png"/></div>
          </div>
         
          <h4 class="step-title" style="color:#C73CF7;">Ready For Pickup</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/takeaway.png"/></div>
          </div>
        
          <h4 class="step-title">Order Picked Up</h4>
        </div>
    
    <?php
    }

    elseif ($status=="Order Picked Up")
    { 
    ?>
        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/check.png"/></div>
          </div>
        
          <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
       
          <h4 class="step-title" style="color:black;">Preparing Order</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px; width:48px;" src="Images/store.png"/></div>
          </div>
        
          <h4 class="step-title" style="color:black;">Ready For Pickup</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/takeaway.png"/></div>
          </div>
        
          <h4 class="step-title"style="color:green;">Order Picked Up</h4>
        </div>
    
    <?php
    }
    elseif ($status=="ORDER COMPLETED")
    { 
    ?>
        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/check.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:black;">Preparing Order</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px; width:48px;" src="Images/store.png"/></div>
          </div>
         
          <h4 class="step-title" style="color:black;">Ready For Pickup</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/takeaway.png"/></div>
          </div>
         
          <h4 class="step-title"style="color:black;">Order Picked Up</h4>
        </div>

    <?php
    }
 }

 else //Type = Delivery
 {
    //Delivery order tracker     
    if($status=="Order Received")
    { 
    ?>
        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img src="Images/check.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:#F7833C;">Order Received</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
          
          <h4 class="step-title">Preparing Order</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:16px; height:78px; width:47px;" src="Images/food-delivery.png"/></div>
          </div>
          
          <h4 class="step-title">On The Way!</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:17px; height:75px; width:46px;" src="Images/delivered.png"/></div>
          </div>
        
          <h4 class="step-title">Order Delivered</h4>
        </div>

    <?php
    }

    elseif ($status=="Preparing Order")
    { 
    ?>
       <div class="step completed">
         <div class="step-icon-wrap">
           <div class="step-icon"><img src="Images/check.png"/></div>
         </div>
         
         <h4 class="step-title" style="color:black;">Order Received</h4>
       </div>

       <div class="step completed">
         <div class="step-icon-wrap">
           <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
         </div>
       
         <h4 class="step-title" style="color:#00AEC6;">Preparing Order</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:16px; height:78px; width:47px;" src="Images/food-delivery.png"/></div>
          </div>
          
          <h4 class="step-title">On The Way!</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
             <div class="step-icon"><img style="padding-top:17px; height:75px; width:46px;" src="Images/delivered.png"/></div>
          </div>
      
          <h4 class="step-title">Order Delivered</h4>
        </div>

    <?php
    }

    elseif ($status=="Order Is On The Way")
    { 
    ?>
        <div class="step completed">
           <div class="step-icon-wrap">
             <div class="step-icon"><img src="Images/check.png"/></div>
           </div>
           
           <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
             <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
        
          <h4 class="step-title" style="color:black;">Preparing Order</h4>
        </div>

        <div class="step completed">
           <div class="step-icon-wrap">
             <div class="step-icon"><img style="padding-top:16px; height:78px; width:47px;" src="Images/food-delivery.png"/></div>
           </div>
          
          <h4 class="step-title" style="color:#C73CF7;">On The Way!</h4>
        </div>

        <div class="step">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:17px; height:75px; width:46px;" src="Images/delivered.png"/></div>
          </div>
     
          <h4 class="step-title">Order Delivered</h4>
        </div>
    
    <?php
    }

    elseif ($status=="Order Delivered")
    { 
    ?>
        <div class="step completed">
           <div class="step-icon-wrap">
             <div class="step-icon"><img src="Images/check.png"/></div>
           </div>
           
          <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:black;">Preparing Order</h4>
        </div>

        <div class="step completed">
            <div class="step-icon-wrap">
                <div class="step-icon"><img style="padding-top:16px; height:78px; width:47px;" src="Images/food-delivery.png"/></div>
            </div>
            <h4 class="step-title" style="color:black;">On The Way!</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:17px; height:75px; width:46px;" src="Images/delivered.png"/></div>
          </div>
    
          <h4 class="step-title" style="color:green;">Order Delivered</h4>
        </div>

    <?php
    }

    elseif ($status=="ORDER COMPLETED")
    { 
    ?>
        <div class="step completed">
          <div class="step-icon-wrap">
             <div class="step-icon"><img src="Images/check.png"/></div>
          </div>
        
          <h4 class="step-title" style="color:black;">Order Received</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:15px;" src="Images/cooking.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:black;">Preparing Order</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:16px; height:78px; width:47px;" src="Images/food-delivery.png"/></div>
          </div>
          
          <h4 class="step-title" style="color:black;">On The Way!</h4>
        </div>

        <div class="step completed">
          <div class="step-icon-wrap">
            <div class="step-icon"><img style="padding-top:17px; height:75px; width:46px;" src="Images/delivered.png"/></div>
          </div>
         
          <h4 class="step-title" style="color:black;">Order Delivered</h4>
        </div>

    <?php
    }
 }
