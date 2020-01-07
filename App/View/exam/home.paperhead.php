    <li class="fl <?php if(ACTION =='trainingEveryday'){ echo curr;} ?>">
        <a href="<?php echo M_URL($this->AppName.'/Index','trainingEveryday','',GP('')); ?>">每日一练</a>
    </li>
    <li class="fl <?php if(ACTION =='index'){ echo curr;} ?>">
        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>">试333卷管理</a>
    </li>
    <li class="fl <?php if(ACTION =='TkIndex'){ echo curr;} ?>">
        <a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>" class="alignCenter">题库管理</a>
    </li>
   <li class="fl <?php if(ACTION =='paperAdd'){ echo curr;} ?>">
        <a href="<?php echo M_URL($this->AppName.'/Index','paperAdd','',GP('')); ?>" class="alignCenter"><i class="iconfont icon-jiahao"></i> 试卷添加 </a>
    </li>
   <li class="fl <?php if(ACTION =='addTk'){ echo curr;} ?>">
        <a href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>" class="alignCenter"><i class="iconfont icon-jiahao"></i> 题库添加</a>
    </li>
