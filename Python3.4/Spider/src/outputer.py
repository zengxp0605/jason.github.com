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
     
        file_name = '../output/json/movies_all.json'
            
        fout = open(file_name,'w',encoding='utf-8')
        _str = json.dumps({'total':len(self.datas),'rows':self.datas},ensure_ascii=False)
        fout.write(_str)
        
        fout.close()  
        
    def output_json_bypage(self):
        page_size = 10
        page = 1
        total = len(self.datas)
        end_page = math.ceil(total/page_size)
        print(end_page)
        for page in range(page,end_page + 1):
            file_name = '../output/json/page_%d.json'%page
            fout = open(file_name,'w',encoding='utf-8')
            start = (page-1)*page_size
            stop = page*page_size
            _dict = {}
            _dict['rows'] = self.datas[start:stop]
            _dict['total'] = total
            _dict['pageSize'] = page_size
            print(page,start,stop)
            fout.write(json.dumps(_dict,ensure_ascii=False))
        
            fout.close() 
            
        
    
    def output_html(self):  
            
        fout = open('../output/movies.html','w',encoding='utf-8')
        #=======================================================================
        # #open(file, mode='r', buffering=_1, encoding=None, errors=None, newline=None, closefd=True, opener=None)
        # fout.write('瀵兼紨: 闆峰痉鍒┞锋柉绉戠壒 Ridley Scott&nbsp;&nbsp;&nbsp;涓绘紨: 涔斾粈路鍝堝鐗� Josh Hartnett / ...')
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
                fout.write(data['year'] + '骞�')
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
                print('鍐欏叆澶辫触: %s'%(data['title']))
           
            sort = sort + 1
            
        fout.write('</table></body>')
        fout.write('</html>')
        
        fout.close()


    

