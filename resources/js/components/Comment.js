//import React from 'react';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import  { Redirect } from 'react-router-dom'
  export default class Comment extends Component 
  {
    _isMounted = false;
    constructor(props) {
      super(props);
      this.state={
        comment_data:[],
        replay_data:[],
        loading:true,
      };
    }
      
    componentDidMount() 
    {
        let data_text= $('#comment_show_all').attr("data-text"); //get the data attribute variable
        const config={
            headers:{
                Authorization:'Bearer'+localStorage.getItem('token')
            }
        };

        this._isMounted = true;
        axios.get('http://127.0.0.1:8000/api/showcomments/'+data_text,config)
          .then(res => {
            //console.log(res.data);
            if (this._isMounted) {
                if(res.data.status==200)
                {
                    this.setState({
                        comment_data:res.data.commentes,
                        replay_data:res.data.replays,
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
            this.state.comment_data.map((item,pos)=>{
                return(
                    <div className="row text-right mt-3" key={pos}>
                    <div className="col-md-1">
                        <i className="fa fa-user comment-user-icon">
                        </i>
                </div>
                    <div className="col-md-9">
                        <div className="col">
                            <h5 className="font-defult">
                                <span className="m-2 font-defult">
                                    {item.created_at}</span> {item.name} 
                            </h5>
                        </div>
                        <div className="col">
                            <p className="direction-defult font-defult" >
                                {item.content} 
                            </p> 
                        </div>
                        
                                {
                                    this.state.replay_data.map((replay,pos)=>
                                    {
                                        return(
                                            
                                                replay.comment_id==item.id?(
                                                    <div className="col" key={pos}>
                                                    <p className="bg-dark text-white font-defult p-2 text-right rounded">
                                                            <span className="fa fa-reply text-info m-2 ">
                                                                <span className="text-danger font-defult text-right ">Admin</span>
                                                            </span>
                                                            <span>
                                                                {replay.c_replay}
                                                                
                                                            </span>
                                                    </p>
                                                </div>
                                            ):
                                            (
                                                <span key={pos}>
                                                </span>
                                            )
                                            
                                        );
                                        
                                    })
                                 }
                            
                    </div>
                    </div>
                );
            });
        }
        return (

            <div>
              {comment_HTMLTABLE}
            </div>
           
        );
    }
}

    if (document.getElementById('comment_show_all')) 
    {
         ReactDOM.render(<Comment />, document.getElementById('comment_show_all'));
    }
