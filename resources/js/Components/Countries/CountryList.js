import React, { useState, useEffect } from 'react';
import Button from '@/Components/Button';
import { Head } from '@inertiajs/inertia-react';
import { router } from '@inertiajs/react';

const CountryList = ({countries, setEditForm}) => {
//   const [countries, setCountries] = useState([]);

//     useEffect(() => {
//         setCountries([
//             { name: 'United States', iso: 'US' },
//             { name: 'Canada', iso: 'CA' },
//             { name: 'Mexico', iso: 'MX' },
//         ]);
//     }, []);

const removeCountry = (country) => {
    console.log(country);
    router.delete(route('country.destroy', country.id));
}

  return (
    <div>
      <Head title="List of Countries" />
      <div className='p-6 bg-slate-200 border-b border-gray-200'> List of Countries</div>
      <div className='container mx-auto px-6'>
        <div className="row justify-content-center">
            <table className="w-2/3 table-auto">
                <thead className="border-b border-gray-400">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>ISO</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                {countries.map((country, index) => (
                    <tr key={index} className="border-b border-gray-200">
                        <td >{index + 1}</td>
                        <td >{country.name}</td>
                        <td onClick={(country) => submit(country)}>{country.code}</td>
                        <td >
                            <Button type='button' className="ml-4 bg-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            onClick={() => setEditForm(country)}
                            >Edit</Button>
                            <Button type='button' className="ml-4 bg-red hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onClick={() => removeCountry(country)}
                            >Delete</Button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
        </div>
    </div>
  );
};

export default CountryList;
