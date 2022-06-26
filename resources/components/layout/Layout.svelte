<script>

import Header from "./Header.svelte";
</script>
 <nav class="flex flex-row bg-sky-200 p-3">
     <div class="container mx-auto">
         <slot name="header">
              <Header />
         </slot>
     </div>

 </nav>
<div class="container mx-auto">
    <slot name="content">

    </slot>
</div>
