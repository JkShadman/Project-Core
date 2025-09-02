import React, {useState} from 'react';

export default function PlayerSearch({endpoint='/players'}) {
  const [q, setQ] = useState('');
  const [results, setResults] = useState([]);

  const search = async (e) => {
    e.preventDefault();
    const res = await fetch(endpoint + '?q=' + encodeURIComponent(q));
    const text = await res.text();
    // For prototype: you might want a JSON endpoint; this simply reloads page normally.
    setResults([]); // placeholder
    window.location.href = endpoint + '?q=' + encodeURIComponent(q);
  };

  return (
    <form onSubmit={search} style={{display:'flex',gap:8}}>
      <input value={q} onChange={e=>setQ(e.target.value)} placeholder="Search players..." />
      <button>Search</button>
    </form>
  );
}
