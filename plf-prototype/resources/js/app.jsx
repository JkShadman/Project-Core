import React from 'react';
import { createRoot } from 'react-dom/client';
import PlayerSearch from './components/PlayerSearch';

const el = document.getElementById('react-player-search');
if (el) {
  createRoot(el).render(<PlayerSearch endpoint="/players" />);
}