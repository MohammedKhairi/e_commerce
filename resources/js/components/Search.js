//import React from 'react';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import  { Redirect } from 'react-router-dom'
import { isNull } from 'lodash';
  export default class Search extends Component 
  {
    _isMounted = false;
    constructor(props) {
      super(props);
      this.state={
        search:[],
        datatext:props.data||"",
        loading:true,
        empty:true,
      };
    }

      
    componentDidMount() 
    {

        let search_text=this.state.datatext;
        const sendGetRequest = async () => {
            try {
                this._isMounted = true;
                axios.get('http://127.0.0.1:8000/api/search/'+search_text,config)
                .then(res => {
                    if (this._isMounted) {
                        if(res.data.status==200)
                        {
                            this.setState({
                                search:res.data.products,
                                loading:false,
                                empty:false,
                            });
                        }
                        if(res.data.status==404)
                        {
                            this.setState({
                                search:res.data.products,
                                loading:false,
                                empty:true,
                            });
                        }
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };
        
        sendGetRequest();

        const config={
            headers:{
                Authorization:'Bearer'+localStorage.getItem('token')
            }
        };
        
    }
    componentWillUnmount() {
        this._isMounted = false;
      }
    render()
    {
        var search_HTMLTABLE="";
        //this.state.datatext=this.props.data;
        //console.log("mo"+this.state.datatext);

        if(this.state.loading)
        {
            search_HTMLTABLE=<tr><td calspan="4"><h2>loading</h2></td></tr>;

        }
        else
        {
            if(this.state.empty)
            {
                search_HTMLTABLE=<tr><td calspan="4"></td></tr>;
            }
            else
            {
                search_HTMLTABLE=

                this.state.search.map((item,pos)=>{
                    return(
                        <tr key={pos}>
                            <td>{item.name}</td>
                            <td>{item.c_name}</td>
                            <td>{item.price}</td>
                            <td>
                                <a className="text-success font-defult" 
                                    href={"http://127.0.0.1:8000/Product/" + item.id}>
                                    <i className="fa fa-eye text-success fa-lg"></i>
                                </a>
                            </td>


                        </tr>
                    );
                });
            }
 
        }
        return (
            this.props.data !=null ||this.props.data!=""||this.props.data.replace(/ /g,'') !=""?
            <div className="dropdown-menu d-flex w-100">
                <table className="table direction-defult font-defult text-center">
                    <thead>
                        <tr>
                            <th  scope="col">أسم المنتج</th>
                            <th  scope="col">التصنيف</th>
                            <th  scope="col">السعر</th>
                            <th  scope="col">عرض</th>
                        </tr>
                    </thead>
                    <tbody>
                         {search_HTMLTABLE}
                    </tbody>
                </table>
           </div>
            :<div></div>
       );
    }
}
    // if (document.getElementById('search')) 
    // {
    //      ReactDOM.render(<Search />, document.getElementById('search'));
    // }
    $("#search_input").on('change keydown paste input', function(){
        var data = $('#search_input').val();
        var dataspace=data.replace(/ /g,'');
        if(data == " "||data =="" ||dataspace==""||dataspace==" ")
        {
            $('#search_input').attr("value", "");
            $('#search_input').attr("placeholder", "أدخل نص صحيح");
        }
        else
        {
            ReactDOM.render(<Search data={data}/>, document.getElementById('search'));
        }
  });
