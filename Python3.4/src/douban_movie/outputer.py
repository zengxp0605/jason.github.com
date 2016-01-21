import json
import math

class Outputer(object):
    
    def __init__(self):
        self.datas = []
    
    def collect_data(self,data):
        if data is None:
            return
        
        self.datas.extend(data)
        
    def output_json(self):
     
        file_name = 'output/movies.json'
            
        fout = open(file_name,'w',encoding='utf-8')
        _str = json.dumps(self.datas,ensure_ascii=False)
        fout.write(_str)
        
        fout.close()  
        
    def output_json_bypage(self):
        page_size = 10
        page = 1
        end_page = math.ceil(len(self.datas)/page_size)
        print(end_page)
        for page in range(page,end_page + 1):
            file_name = 'output/json/page_%d.json'%page
            fout = open(file_name,'w',encoding='utf-8')
            start = (page-1)*page_size
            stop = page*page_size
            arr = self.datas[start:stop]
            print(page,start,stop)
            fout.write(json.dumps(arr,ensure_ascii=False))
        
            fout.close() 
            
        
    
    def output_html(self):  
            
        fout = open('output/movies.html','w',encoding='utf-8')
        #=======================================================================
        # #open(file, mode='r', buffering=_1, encoding=None, errors=None, newline=None, closefd=True, opener=None)
        # fout.write('导演: 雷德利·斯科特 Ridley Scott&nbsp;&nbsp;&nbsp;主演: 乔什·哈奈特 Josh Hartnett / ...')
        # fout.close()
        # return
        #=======================================================================
        
        fout.write('<html>')
        fout.write('<body><table>')
        sort = 1
        for data in self.datas:
            try:
                fout.write('<tr><td>')
                fout.write(str(sort))
                fout.write('</td><td>')
                fout.write('<a href="%s">%s</a>'%(data['detail_url'],data['title']))
        
                fout.write('</td><td>')
                fout.write(data['year'] + '年')
                fout.write('</td><td>')
                fout.write(data['score'])
                fout.write('</td><td>')
                fout.write('<img src="%s" />'%(data['img']))
                fout.write('</td><td>')
                fout.write(data['desc'])
                fout.write('</td><td>')
                fout.write(data['intro'])
                fout.write('<td></tr>')
            except:
                print('写入失败: %s'%(data['title']))
           
            sort = sort + 1
            
        fout.write('</table></body>')
        fout.write('</html>')
        
        fout.close()


    

