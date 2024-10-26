"use client";
import React, { useEffect, useState } from 'react';

const Page: React.FC = () => {
  const [imageSrc, setImageSrc] = useState<string | null>(null);
  const [overlayText, setOverlayText] = useState<string | null>(null);
  const [errorMessage, setErrorMessage] = useState<string | null>(null);

  useEffect(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    const fetchData = async () => {
      try {
        const response = await fetch('http://103.216.159.92:3000/api/data/ske/skeskcc');
        const data = await response.json();
          if (data.value === 'same' || data.status === 'same') {
            setImageSrc('image/default.png');
            setOverlayText(null);
            setErrorMessage(null);
          } else if (data.value === 'black' || data.status === 'black') {
            setImageSrc('image/black.png');
            setOverlayText(null);
            setErrorMessage(null);
          } else {
            setOverlayText(`Page ID : ${id}`);
            const images: { [key: string]: string } = {
              '1': '1.png',
              '2': '2.png',
              '3': '3.png',
              '4': '4.png',
              '5': '5.png',
              '6': '6.png',
              '7': '7.png',
              '8': '8.png',
            };
            if (images[id!]) {
              setImageSrc(`image/${images[id!]}`);
              setErrorMessage(null);
            } else {
              setImageSrc(null);
              setErrorMessage(`Image not found for ID: ${id}`);
            }
          }
        } catch (error) {
          console.error('Error fetching config.json:', error);
        }
    };

    const intervalId = setInterval(fetchData, 300);
    return () => clearInterval(intervalId);
  }, []);

  return (
    <div style={{ backgroundColor: 'black', color: 'white', fontFamily: "'IBM Plex Sans Thai', sans-serif", fontSize: 'small', overflow: 'hidden' }}>
      <div id="image" style={{ position: 'relative' }}>
        {imageSrc && <img src={imageSrc} alt="Dynamic" style={{ width: '100vw', height: '100vh', objectFit: 'cover' }} />}
        {overlayText && (
          <div style={{ position: 'absolute', top: '25px', left: '25px', color: 'white', backgroundColor: 'rgba(0, 0, 0, 0.5)', padding: '1px', borderRadius: '1px' }}>
            {overlayText}
          </div>
        )}
        {errorMessage && <div style={{ color: 'white' }}>{errorMessage}</div>}
      </div>
    </div>
  );
};

export default Page;