## 配置
    common/config/main-local.php 
    
    <?php
    return [
        'components' => [
            
            //  增加如下配置
            'remindBot' => [
                'class' => '\wzzwx\yii2DingtalkRobot\Client',
                'params' => [
                    'default' => [
                        'token' => '76f1c37075e4727a2de1exxxxxxxxxxxxxxxxxxbd0f2a18d025395294d6',
                        'ssl_verify' => false,
                    ],
                    'news' => [
                        'token' => '5afca7e2exxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx636b5d64b32',
                        'ssl_verify' => false,
                        'secret' => 'SEC5f845205f503c2xxxxxxxxxxxxxxxxxxxxxxxxxxxxcae183d67e980e',
                    ],
                ],
            ],
            
            // ...
## 使用
    public function actionMarkdown()
        {
            $title = '测试提醒';
            $markdown = '# ' . '测试title' . "\n\n";
            $markdown .= '用户姓名：' . 'wz' . "\n\n";
            $markdown .= '用户微信：' . 'wz152309246' . "\n\n";
            $res = Yii::$app->remindBot->markdown($title, $markdown);
            var_dump($res);
        }
    
        public function actionText()
        {
            $doc = "新闻 测试  \n\n 哇凉哇凉完了完了我";
            $res = Yii::$app->remindBot->with('news')->text($doc);
            var_dump($res);
        }
    
        public function actionLink()
        {
            $title = "自定义机器人协议";
            $text = "群机器人是钉钉群的高级扩展功能。群机器人可以将第三方服务的信息聚合到群聊中，实现自动化的信息同步。例如：通过聚合GitHub，GitLab等源码管理服务，实现源码更新同步；通过聚合Trello，JIRA等项目协调服务，实现项目信息同步。不仅如此，群机器人支持Webhook协议的自定义接入，支持更多可能性，例如：你可将运维报警提醒通过自定义机器人聚合到钉钉群。";
            $picUrl = "";
            $messageUrl = "https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.Rqyvqo&treeId=257&articleId=105735&docType=1";
    
            $res = Yii::$app->remindBot->with('news')->link($title,$text,$messageUrl,$picUrl);
            var_dump($res);
        }
    
        public function actionSigle()
        {
            $title = "乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身";
            $text = "![screenshot](@lADOpwk3K80C0M0FoA) \n".
                " #### 乔布斯 20 年前想打造的苹果咖啡厅 \n\n".
                " Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
    
            $res = Yii::$app->remindBot->with('news')->actionCard($title,$text,1)
                ->single("阅读全文","https://www.dingtalk.com/")
                ->send();
            var_dump($res);
        }
    
        public function actionBtn()
        {
            $title = "btn 乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身";
            $text = "![screenshot](@lADOpwk3K80C0M0FoA) \n".
                " #### 乔布斯 20 年前想打造的苹果咖啡厅 \n\n".
                " Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
    
            $res = Yii::$app->remindBot->with('news')->actionCard($title,$text,1)
                ->addButtons("内容不错","https://www.dingtalk.com/")
                ->addButtons("不感兴趣","https://www.dingtalk.com/")
                ->send();
            var_dump($res);
        }
    
        public function actionFeed()
        {
            $messageUrl = "https://mp.weixin.qq.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI";
            $picUrl = "https://www.dingtalk.com";
            $res = Yii::$app->remindBot->with('news')->feed()
                ->addLinks('时代的火车向前开',$messageUrl,$picUrl)
                ->addLinks('时代的火车向前开2',$messageUrl,$picUrl)
                ->send();
            var_dump($res);
        }
