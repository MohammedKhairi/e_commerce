//import React from 'react';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import  { Redirect } from 'react-router-dom'
  export default class User extends Component 
  {
    _isMounted = false;
    constructor(props) {
      super(props);
      this.state={
        favorite:[],
        loading:true,
      };
    }
      
    componentDidMount() 
    {
        const config={
            headers:{
                Authorization:'Bearer'+localStorage.getItem('token')
            }
        };

        this._isMounted = true;
        axios.get('http://127.0.0.1:8000/api/userfavorite',config)
          .then(res => {
            //console.log(res.data);
            if (this._isMounted) {
                if(res.data.status==200)
                {
                    this.setState({
                        favorite:res.data.favorite,
                        loading:false,
                    });
                }
                if(res.data.status=='error')
                {
                    alert('Login to Show')
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
        var favorite_HTMLTABLE="";
        if(this.state.loading)
        {
            favorite_HTMLTABLE=<tr><td calspan="4"><h2>loading</h2></td></tr>;

        }
        else
        {
            favorite_HTMLTABLE=
            this.state.favorite.map((item)=>{
                return(
                    <tr key={item.p_id}>
                        <td>{item.p_name}</td>
                        <td>{item.p_price}</td>
                        <td>{item.c_id}</td>
                        <td>
                           <button type="button" className="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>

                );
            });
        }
        return (

            <table className="table">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Process</th>
                    </tr>
                </thead>
                <tbody>
                    {favorite_HTMLTABLE}
                </tbody>
            </table>
        );
    }
}
// DOM element
// if (document.getElementById('user').click) {
//     ReactDOM.render(<User />, document.getElementById('user'));
// }
// document.getElementById('user').onclick = function() {
//     ReactDOM.render(<User />, document.getElementById('user'));
//  }​;​
    if (document.getElementById('comment')) 
    {
         ReactDOM.render(<User />, document.getElementById('comment'));
    }
