#### 一个基于 [@wuxia2001/loveyue](https://github.com/wuxia2001/loveyue) 表白网站源码

运行环境 Apache/Nginx/IIS + php 5.3 laster

> 数据库文件 love.db;
> 
> 数据库名 love  数据表 love
> 
> love表结构

|Field|Type|Null|Key|Default|Extra
| ---- | ---- | ---- | ---- | ---- | ---- |
| love_id    | INTEGER     | NO | PRI | NULL | auto_increment |
| love_text   | text | NO | | NULL | |
| love_date | text      | NO | | date('now') | |

#### 修改

添加 PHP代码实现以下功能

+ 根据 id 查找文本,id = 0 默认倒序 第一个文章
+ 使用SQLite3数据库
+ POST.PHP 可以提交文本到数据库