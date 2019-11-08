<template>
    <div class="comments">
    	<div class="comments-form">
    		<input type="text">
    		<button class="button">Добавить комментарий</button>
    	</div>
    	
    </div>

  
</template>

<script>
 
    export default {
  
        mounted() {
            console.log('Component mounted.')
        },

    }
    
</script>

<style scoped>
	.comments .comments-form input {
		border: none;
		border-bottom: 2px solid #000; 
	}

	.comments .comments-form button.button {
		border: 2px solid #e71d43;
        padding: 14px 30px;
        cursor: pointer;                
        font-size: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 3px; 
        background-color: transparent;
        color: #000;
	}

	.comments .comments-form button.button:hover {
		background-color: #e71d43;
        color: #fff;
        border: 2px solid #e71d43;
        transition: all 0.3s ease-in-out;
	}

	.comments .comments-form button.button:not(:hover) {
		background-color: transparent;
        color: #000;
        transition: all 0.3s ease-in-out;
	}
	
</style>