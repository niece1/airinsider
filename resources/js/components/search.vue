<template>
<div>

  <ais-instant-search :search-client="searchClient" index-name="posts">
    <ais-search-box />
    <ais-hits>

<div class="news">
<div class="news-wrapper">
      <div slot="item" slot-scope="{ item }" class="item">
        

    
    
        
        
        
            <div class="image-holder">
                <a href="#">
                    <img class="lazyload"
                        src="#"
                        data-src="#" alt="Photo">
                    <div class="image-overlay"></div>
                </a>
            </div>
            
            <div class="item-content">
                <a href="">
                    <h6>{{item.title}}</h6>
                </a>
                <p class="item-blog-text">
                    {{ item.description }}
                </p>
                
                <p class="item-blog-author">
                    <i class="fas fa-user-edit"></i>
                    <a href="#">
                        
                    </a>
                </p>
              
                <p>
                    <i class="fas fa-clock"></i>
                    Время чтения:  мин.
                </p>
                <p class="item-blog-comment">
                    Комментарии: 
                </p>
                <p class="item-blog-date"></p>                
                <div class="blog-line">
                </div>
                <div class="item-blog-bottom">
                    <a href="#" class="button">
                        Читать
                    </a>
                   
                    <p>
                        <i class="fas fa-tags"></i>
                        <a href="#">
                            {{item.category}}
                        </a>
                    </p>
                  
                </div>
            </div>
      
        
   


      </div>
    </ais-hits>
  </ais-instant-search>

 </div>
 </div></div>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';


export default {
  data() {
    return {
      searchClient: algoliasearch(
        'TFLRUDVJEC',
        'e19eaa3efd9f62ecb11e69e000c70f74'
      ),
    };
  },
};
</script>

<style scoped>
.news {
width: 100%;
}

.news {
width: 100%;
}
.news .news-wrapper {
width: 90%;
        margin: 60px auto;
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-gap: 60px 30px;
        justify-content: space-between;
}
</style>

