//import React from 'react';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import  { Redirect } from 'react-router-dom'
  export default class Related extends Component 
  {
    _isMounted = false;
    constructor(props) {
      super(props);
      this.state={
        related_data:[],
        loading:true,
      };
    }
      
    componentDidMount() 
    {
        let data_text= $('#related_product_all').attr("data-text"); //get the data attribute variable
        const config={
            headers:{
                Authorization:'Bearer'+localStorage.getItem('token')
            }
        };

        this._isMounted = true;
        axios.get('http://127.0.0.1:8000/api/relatedproduct/'+data_text,config)
          .then(res => {
            console.log(res.data);
            if (this._isMounted) {
                if(res.data.status==200)
                {
                    this.setState({
                        related_data:res.data.related,
                        loading:false,
                    });
                }
            }
          })
          .catch((err) => {
            console.log(err)
          })
    }
    componentWillUnmount() {
        this._isMounted = false;
      }
    render()
    {
        var comment_HTMLTABLE="";
        if(this.state.loading)
        {
            comment_HTMLTABLE=<p>loading</p>;

        }
        else
        {
            comment_HTMLTABLE=
            this.state.related_data.map((item,pos)=>{
                return(
                    <div className="col-md-3" key={pos}>
                        <div className="card mt-3">
                            <div className="product-1 align-items-center p-2 text-center">
                                <img src="" alt="" className="rounded" width="160px"/>
                                <h5>{item.c_name}</h5>
                                <div className="mt-3 info">
                                    <span className="text1 d-block">
                                    {item.name}
                                    </span>
                                    <span className="text1 ">
                                        {item.detail.substring(0, 100)}
                                    </span>
                                </div>
                
                                <div className="cost mt-3 text-dark">
                                    <span>{item.price} IQD</span>
                                    <div className="star mt-3 align-items-center">
                                    <i className="fa fa-star"></i>
                                    <i className="fa fa-star"></i>
                                    <i className="fa fa-star"></i>
                                    <i className="fa fa-star"></i>
                                    <i className="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div className="p-3 shoe text-center text-white mt-3 cursor">
                                
                                <div className="row">
                                    <div className="col text-center text-white font-defult">
                                         <a className="text-white font-defult"
                                          href={"http://127.0.0.1:8000/Product/" + item.id}>
                                        </a>
                                    </div>
                                </div>      
                            </div>
                        </div>
                </div>  
                );
            });
        }
        return (
            <div className="row">
               {comment_HTMLTABLE}
            </div>

        );
    }
}

    if (document.getElementById('related_product_all')) 
    {
         ReactDOM.render(<Related />, document.getElementById('related_product_all'));
    }
