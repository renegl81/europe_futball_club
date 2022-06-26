<script>
    import { page } from '@inertiajs/inertia-svelte'
    let leagues =  $page.props.leagues
    console.log(leagues);
</script>

 <ul class="flex flex-row">
     {#each leagues as league}
        <li><img src="/storage/images/leagues/{league.logo}"  width="50" alt="{league.name}"> {league.name}</li>
         {/each}
 </ul>
